<?php

namespace App\Core\Exceptions\Enumerations;

use App\Core\Exceptions\Contracts\Enumeration;

enum ErroComun: string implements Enumeration {
    case ERRO_INTERNO = '001';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match($this) {
            self::ERRO_INTERNO => 'Um erro desconhecido ocorreu',
        };
    }
}
