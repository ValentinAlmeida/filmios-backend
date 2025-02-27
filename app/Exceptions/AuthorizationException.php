<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    protected function __construct(
        public readonly string $codigo,
        public readonly string $recurso,
        public readonly ?string $campo = null,
        public readonly ?\Throwable $previous = null,
    ) {
    }

    public static function prohibitedAuthenticate(string $recurso, ?string $campo = null)
    {
        return new static('301', $recurso, $campo);
    }
}
