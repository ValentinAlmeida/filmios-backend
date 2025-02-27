<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AuthenticationServiceInterface;
use App\Core\VO\TokenJwt;
use App\Exceptions\AuthenticationException;
use App\Http\Requests\AuthenticateRequest;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Http\Requests\RefreshTokenRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Infra\Helpers\TokenHelper;
use App\Support\Serializers\UserSerializer;

class AuthenticationController extends Controller
{
    public function __construct(
        private readonly AuthenticationServiceInterface $authenticationService,
        )
    {
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $user = $this->authenticationService->authenticate($request->getCredential());
        $refreshToken = $this->authenticationService->generateRefreshToken($user);

        return TokenHelper::withToken($this->authenticationService->generateToken($user, $refreshToken), $refreshToken);
    }

    public function unblockAccess(int $id)
    {
        $this->authenticationService->unblockAccess($id);

        response(null, 204);
    }

    public function recoverPassword(RecoveryPasswordRequest $request)
    {
        $this->authenticationService->recoverPassword($request->getRecoveryPasswordDTO());

        return response()->json(['message' => 'Um e-mail de recuperação de senha foi enviado.'], 200);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $this->authenticationService->resetPassword($request->getResetPasswordDTO());

        return response('', 201);
    }

    public function refreshToken(RefreshTokenRequest $request)
    {
        return $this->authenticationService->refreshToken($request->getRefreshToken());
    }
}
