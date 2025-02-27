<?php

namespace App\Core\Exceptions\Enumerations;

use App\Core\Exceptions\Contracts\Enumeration;

enum ValidationError: string implements Enumeration
{
    case VALIDACAO_REQUISICAO = '401';

    public function codigo(): string
    {
        return $this->value;
    }

    public function mensagem(): string
    {
        return match ($this) {
            self::VALIDACAO_REQUISICAO => 'Erro de validação',
        };
    }
}
