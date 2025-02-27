<?php

namespace App\Exceptions;

use App\Core\Exceptions\ExceptionCore;

class RequestException extends ExceptionCore
{
    const NAME  = 'solicitação';

    public static function notFound() {
        return new static(self::NAME, '101');
    }
}
