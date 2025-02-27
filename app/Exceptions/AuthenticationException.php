<?php

namespace App\Exceptions;

use App\Core\Exceptions\Enumerations\AuthenticationError;
use Exception;

class AuthenticationException extends Exception
{
    protected function __construct(
        public readonly string $codigo,
        public readonly ?string $token = null,
        public readonly ?\Throwable $previous = null,
    ) {
    }

    public static function credentialsInvalid()
    {
        return new static(AuthenticationError::CREDENCIAIS_INVALIDAS->codigo());
    }

    public static function tokenNotFound()
    {
        return new static(AuthenticationError::TOKEN_NAO_ENCONTRADO->codigo());
    }

    public static function invalidToken(string $token)
    {
        return new static(AuthenticationError::TOKEN_INVALIDO->codigo(), $token);
    }

    public static function tokenExpired(string $token)
    {
        return new static(AuthenticationError::TOKEN_EXPIRADO->codigo(), $token);
    }

    public static function refreshTokenExpired(string $token)
    {
        return new static(AuthenticationError::REFRESH_TOKEN_EXPIRADO->codigo(), $token);
    }

    public static function accessBlocked() {
        return new static(AuthenticationError::ACESSO_BLOQUEADO->codigo());
    }
}
