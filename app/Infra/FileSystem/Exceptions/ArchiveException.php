<?php

namespace App\Infra\FileSystem\Exceptions;

use App\Infra\FileSystem\Contracts\Path;

class ArchiveException extends \Exception
{
    public function __construct(string $message, private Path $path, ?\Throwable $previous = null)
    {
        parent::__construct($message, previous: $previous);
    }

    public function getPath(): string
    {
        return strval($this->path);
    }

    public static function alreadyExists(Path $path, ?\Throwable $previous = null): static
    {
        return new static('Arquivo já existe', $path, $previous);
    }

    public static function notFound(Path $path, ?\Throwable $previous = null): static
    {
        return new static('Arquivo não encontrado', $path, $previous);
    }
}
