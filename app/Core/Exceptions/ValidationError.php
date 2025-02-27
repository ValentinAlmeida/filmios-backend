<?php

namespace App\Core\Exceptions;

use App\Core\Exceptions\Enumerations\ValidationError as Enumeracao;
use Illuminate\Contracts\Validation\Validator;

class ValidationError extends BaseError
{
    private function __construct(
        public Validator $validator,
        string $mensagem,
        string $codigo,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($mensagem, 'ValidacaoError', $codigo, $previous);

        foreach ($validator->errors()->all() as $error) {
            $this->addDetalhe(['regra' => $error]);
        }
    }

    public static function pertence($excecao): ?BaseError
    {
        return match($excecao->codigo) {
            Enumeracao::VALIDACAO_REQUISICAO->codigo() => self::validacaoRequisicao($excecao->validator, $excecao->previous)
        };
    }

    public static function validacaoRequisicao(Validator $validator, ?\Throwable $previous = null)
    {
        return new static(
            $validator,
            Enumeracao::VALIDACAO_REQUISICAO->mensagem(),
            Enumeracao::VALIDACAO_REQUISICAO->codigo(),
            $previous,
        );
    }
}
