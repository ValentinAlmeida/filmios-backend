<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enumerations\ErroComun;

class InternalError extends BaseError
{
    private function __construct(string $mensagem, string $codigo, \Throwable $previous)
    {
        parent::__construct($mensagem, 'ErroInterno', $codigo, $previous);
    }

    public static function pertence($excecao): ?BaseError
    {
        return null;
    }

    public static function create(\Throwable $previous)
    {
        return new static(
            ErroComun::ERRO_INTERNO->mensagem(),
            ErroComun::ERRO_INTERNO->codigo(),
            $previous,
        );
    }
}
