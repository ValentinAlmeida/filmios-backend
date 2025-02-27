<?php

namespace App\Http\Middleware;

use App\Contracts\Services\AuthenticationServiceInterface;
use App\Core\Exceptions\AuthenticationError;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class RefreshToken extends Middleware
{
    public function __construct(
        private readonly AuthenticationServiceInterface $authenticationServiceInterface,
    ) {
    }

    protected function authenticate($request, array $guards)
    {
        $token = $request->header('Authorization') ?? $request->query('token');

        throw_if(empty($token), AuthenticationError::tokenNaoEncontrado());

        app()->instance('token', substr($token, 7));

        app()->instance('user', $this->authenticationServiceInterface->getAuthenticableByToken($token, true));

        return next($request);
    }
}
