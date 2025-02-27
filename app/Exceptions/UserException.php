<?php

namespace App\Exceptions;

use App\Core\Exceptions\ExceptionCore;

class UserException extends ExceptionCore
{
    const NAME  = 'usuario';
    const CPF = 'cpf';

    public static function notFound() {
        return new static(self::NAME, '101');
    }

    public static function alreadyExists(?string $campo = null) {
        return new static(self::NAME, '102', $campo);
    }

    public static function isInactive() {
        return new static(self::NAME, '104', null, 'Usuário está inativo');
    }
}
