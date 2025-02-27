<?php

namespace App\Infra;

use App\Infra\FileSystem\Contracts\Path;

abstract class CDNPath implements Path
{
    private string $url;

    private string $path;

    protected function __construct(?string $url = null)
    {
        $this->setURL($url);
    }

    public static function build(string $path)
    {
        $cdnPath = new static();
        $cdnPath->setPath(str($path)->after($cdnPath->url)->value());

        return $cdnPath;
    }

    protected function setURL(string $url)
    {
        $url = str($url);

        if ($url->endsWith('/')) {
            $url = $url->beforeLast('/');
        }

        $this->url = $url->value();
    }

    protected function setPath(string $path)
    {
        $path = str($path);

        if (!$path->startsWith('/')) {
            $path = $path->start('/');
        }

        $this->path = $path->value();
    }

    public function absolute(): string
    {
        return str($this->url)->append($this->path)->value();
    }

    public function relative(): string
    {
        return $this->path;
    }

    public function exists(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->absolute();
    }

    public function isArchive(): bool
    {
        return false;
    }

    public function isDirectory(): ?bool
    {
        return false;
    }

    public function directory(): Path
    {
        return $this;
    }

    public function attach(string $sub): Path
    {
        return $this;
    }

    public function base() : string{
        return '';
    }
}
