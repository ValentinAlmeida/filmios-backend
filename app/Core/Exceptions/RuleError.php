<?php

namespace App\Core\Exceptions;

class RuleError extends ExceptionCore
{
    public static function jaExiste(string $nome, string $campo) {
        return new static($nome, '102', $campo);
    }
}
