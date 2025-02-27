<?php

namespace App\Exceptions;

use App\Core\Exceptions\BaseError as ExcecaoCore;
use App\Contracts\Exceptions\Renderable;

class ApiException extends ExcecaoCore implements Renderable
{
    public function __construct(
        string $mensagem,
        string $nome,
        string $codigo,
        protected int $httpStatus,
        ?\Throwable $previous = null
    ) {
        parent::__construct($mensagem, $nome, $codigo, $previous);
    }

    public static function pertence($excecao): ?ExcecaoCore
    {
        return null;
    }

    /**
     * @return int
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    public function render($request)
    {
        $json = [
            "error" => $this->nome,
            "codigo" => $this->codigo,
            "mensagem" => $this->mensagem,
        ];

        if ($this->hasDetalhes()) {
            $json['detalhes'] = $this->getDetalhes();
        }

        if (config('app.debug') && ($previous = $this->previous)) {
            $json['excecao'] = $this->renderPrevious($previous);
        }

        return response()->json($json, $this->getHttpStatus());
    }

    protected function renderPrevious(\Throwable $e)
    {
        $json = [
            "tipo" => $e::class,
            "arquivo" => $e->getFile(),
            "linha" => $e->getLine(),
            "mensagem" => $e->getMessage(),
        ];

        if ($previous = $e->getPrevious()) {
            $json['previous'] = $this->renderPrevious($previous);
        }

        return $json;
    }
}
