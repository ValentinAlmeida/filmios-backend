<?php

namespace App\Exceptions;

use App\Core\Exceptions\ExceptionCore;

class ServiceException extends ExceptionCore
{
    const NAME  = 'serviço';

    public static function notFound() {
        return new static(self::NAME, '101');
    }

    public static function invalid(string $campo) {
        return new static(self::NAME, '106', $campo);
    }
}
