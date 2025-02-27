<?php

namespace App\Http\Middleware;

use App\Contracts\Services\AuthenticationServiceInterface;
use Closure;
use Illuminate\Http\Request;
use App\Core\Exceptions\AuthenticationError;
use Illuminate\Support\Facades\Cache;

class VerifyTokenJWT
{
    public function __construct(private AuthenticationServiceInterface $authenticationServiceInterface)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization') ?? $request->query('token');

        throw_if(empty($token), AuthenticationError::tokenNaoEncontrado());

        app()->instance('user_recovery', $this->authenticationServiceInterface->getAuthenticableByTokenRecovery($token));

        return $next($request);
    }
}
