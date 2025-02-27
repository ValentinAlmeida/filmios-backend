<?php

namespace App\Exceptions;

use App\Core\Exceptions\ExceptionCore;

class EstablishmentException extends ExceptionCore
{
    const NAME  = 'estabelecimento';

    public static function notFound() {
        return new static(self::NAME, '101');
    }

    public static function alreadyExists(?string $campo = null) {
        return new static(self::NAME, '102', $campo);
    }
}
