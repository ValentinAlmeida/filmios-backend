<?php

namespace App\Util;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use App\Infra\FileSystem\Contracts\Archive;

class ArchiveUtil
{
    public static function responseArchive(Archive $archive): SymfonyResponse
    {
        $contentArchive = file_get_contents($archive->getContent()->getLine());

        $response = new SymfonyResponse($contentArchive);

        $response->headers->set('Content-Type', $archive->getTypeMime());

        return $response;
    }
}
