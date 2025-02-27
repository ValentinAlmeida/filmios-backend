<?php

namespace App\Exceptions;

use App\Core\Exceptions\ExceptionCore;

class ProfileException extends ExceptionCore
{
    const NAME  = 'profile';

    public static function notFound() {
        return new static(self::NAME, '101');
    }
}
