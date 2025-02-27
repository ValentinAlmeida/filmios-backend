<?php

namespace App\Core\Exceptions\Enumerations;

use App\Core\Exceptions\Contracts\Enumeration;

enum AuthorizationError: string implements Enumeration
{
    case NAO_AUTORIZADO = '301';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::NAO_AUTORIZADO => 'Não autorizado',
        };
    }
}
