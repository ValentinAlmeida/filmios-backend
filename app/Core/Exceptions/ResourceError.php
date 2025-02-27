<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enumerations\ResourceError as Enumeracao;

class ResourceError extends BaseError
{
    private function __construct(
        string $mensagem,
        string $codigo,
        string $recurso,
        ?string $campo = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($mensagem, 'RecursoError', $codigo, $previous);

        $this->addDetalhe(['recurso' => $recurso, 'campo' => $campo]);
    }

    public static function pertence($excecao): ?BaseError
    {
        return match ($excecao->codigo) {
            Enumeracao::NAO_ENCONTRADO->codigo() => self::naoEncontrado($excecao->recurso, $excecao->campo),
            Enumeracao::INVALIDO->codigo() => self::invalido($excecao->recurso, $excecao->campo),
            Enumeracao::JA_EXISTE->codigo() => self::jaExiste($excecao->recurso, $excecao->campo),
            Enumeracao::NAO_PODE_CRIAR->codigo() => self::naoPodeCriar($excecao->justificativa, $excecao->recurso, $excecao->campo),
            Enumeracao::NAO_PODE_DELETAR->codigo() => self::naoPodeDeletar($excecao->justificativa, $excecao->recurso, $excecao->campo),
            default => null,
        };
    }

    public static function naoEncontrado(string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::NAO_ENCONTRADO->mensagem(),
            Enumeracao::NAO_ENCONTRADO->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }

    public static function invalido(string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::INVALIDO->mensagem(),
            Enumeracao::INVALIDO->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }

    public static function jaExiste(string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        return new static(
            Enumeracao::JA_EXISTE->mensagem(),
            Enumeracao::JA_EXISTE->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }

    public static function naoPodeCriar(string $justificativa, string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        $mensagem = Enumeracao::NAO_PODE_CRIAR->mensagem();

        return new static(
            "{$mensagem} {$justificativa}",
            Enumeracao::NAO_PODE_CRIAR->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }

    public static function naoPodeAtualizar(string $justificativa, string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        $mensagem = Enumeracao::NAO_PODE_ATUALIZAR->mensagem();

        return new static(
            "{$mensagem} {$justificativa}",
            Enumeracao::NAO_PODE_ATUALIZAR->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }

    public static function naoPodeDeletar(string $justificativa, string $recurso, ?string $campo = null, ?\Throwable $previous = null)
    {
        $mensagem = Enumeracao::NAO_PODE_DELETAR->mensagem();

        return new static(
            "{$mensagem} {$justificativa}",
            Enumeracao::NAO_PODE_DELETAR->codigo(),
            $recurso,
            $campo,
            $previous,
        );
    }
}
