<?php

namespace App\Http\Middleware;

use App\Core\Exceptions\Enumerations\AuthorizationError;
use App\Support\Manager\FeatureManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFeaturePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = app('user');

        if (!$user || !$user->getProfile() || !$user->getProfile()?->getFeature()) {
            abort(Response::HTTP_FORBIDDEN, AuthorizationError::NAO_AUTORIZADO->mensagem());
        }

        $features = FeatureManager::fromArray($user->getProfile()->getFeature());

        $requiredFeature = [
            'classe' => $request->route()->getController()::class,
            'function' => $request->route()->getActionMethod(),
        ];

        foreach ($features as $feature) {
            $meta = $feature->withMeta();

            if ($meta['classe'] === $requiredFeature['classe'] &&
                is_array($meta['function']) &&
                in_array($requiredFeature['function'], $meta['function']))
            {
                return $next($request);
            }
        }

        abort(Response::HTTP_FORBIDDEN, AuthorizationError::NAO_AUTORIZADO->mensagem());
    }
}
