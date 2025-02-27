<?php

namespace App\Core\Exceptions;

use Exception;

abstract class ExceptionCore extends Exception
{
    protected function __construct(
        public readonly string $recurso,
        public readonly string $codigo,
        public readonly ?string $campo = null,
        public readonly ?string $justificativa = null,
    ) {
    }
}
