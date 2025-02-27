<?php

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use App\Infra\FileSystem\Contracts\Archive;

function respostaArquivo(Archive $arquivo): SymfonyResponse
{
    $resposta = new SymfonyResponse($arquivo->getContent()->getLinha());

    $resposta->headers->set('Content-Type', $arquivo->getTipoMime());

    return $resposta;
}
