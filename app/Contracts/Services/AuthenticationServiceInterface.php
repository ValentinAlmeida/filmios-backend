<?php

namespace App\Contracts\Services;

use App\Core\Contracts\Authenticable;
use App\Core\Contracts\Token;
use App\Core\DTO\RecoveryPasswordDTO;
use App\Core\DTO\RefreshTokenDTO;
use App\Core\DTO\ResetPasswordDTO;
use App\Core\VO\Credential;
use App\Entities\UserEntity;
use Illuminate\Http\Response;

interface AuthenticationServiceInterface
{
    public function refreshToken(RefreshTokenDTO $refreshTokenDTO): Response;

    public function authenticate(Credential $credential): Authenticable;

    public function generateToken(UserEntity $user, Token $refreshToken, array $extra = null): Token;

    public function generateRefreshToken(UserEntity $user, array $extra = null): Token;

    public function validateToken(string $token): Token;

    public function getAuthenticableByToken(string $token, ?bool $refresh = null): Authenticable;

    public function unblockAccess(int $id): void;

    public function recoverPassword(RecoveryPasswordDTO $recoveryPasswordDTO);

    public function resetPassword(ResetPasswordDTO $resetPasswordDTO);

    public function getAuthenticableByTokenRecovery(string $token): Authenticable;
}
