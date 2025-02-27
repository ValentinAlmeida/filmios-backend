<?php

namespace App\Infra\FileSystem\LaravelStorage;

use App\Infra\FileSystem\Contracts\Content;
use App\Infra\FileSystem\Contracts\Archive as Contrato;
use App\Infra\FileSystem\Exceptions\ArchiveException;
use Symfony\Component\Mime\MimeTypes;
use App\Infra\FileSystem\Contracts\Path;
use Illuminate\Support\Facades\File as Facade;

class Archive implements Contrato
{
    private string $name;

    private ?string $extension = null;

    private Path $path;

    private ?Content $content = null;

    private function __construct(Path $path = null)
    {
        $this->path = $path;
        $this->setExtensionByPath($path);
        $this->setNameByPath($path);
    }

    public function rename(string $name)
    {
        $this->setName($name);
    }

    public static function new(string $name, Path $path, Content $content = null)
    {
        $arquivo = new static($path);

        $arquivo->setName($name);
        $arquivo->setContent($content);

        return $arquivo;
    }

    public static function load(Path $path)
    {
        if (!$path->isArchive()) {
            throw ArchiveException::notFound($path);
        }

        $name = $path->base();

        $archive = static::new($name, $path);

        $archive->loadContent();

        return $archive;
    }

    public static function buildPath(Path $path)
    {
        return new static($path);
    }

    public function getContent(): Content
    {
        $this->loadContent();

        return $this->content;
    }

    public function getName(): string
    {
        return implode('.', [$this->getNameBase(), $this->getExtension()]);
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getPath(): Path
    {
        return $this->path;
    }

    public function getNameBase(): string
    {
        return $this->name;
    }

    public function getTypeMime(): string
    {
        return MimeTypes::getDefault()->getMimeTypes($this->getExtension())[0];
    }

    public function isSaved(): bool
    {
        return $this->getPath()->exists();
    }

    protected function loadContent()
    {
        if (!$this->content) {
            $this->setContent(
                UTF8Content::make($this->getPath()->absolute())
            );
        }
    }

    private function setName(string $name)
    {
        $this->name = str($name)->beforeLast('.');
    }

    private function setContent(?Content $content): void
    {
        $this->content = $content;
    }

    private function setExtensionByPath(Path $path)
    {
        $this->setExtension(Facade::extension($path->absolute()));
    }

    private function setNameByPath(Path $Path)
    {
        $this->setName(Facade::basename($Path->absolute()));
    }


    public function setExtension(string $extension)
    {
        $this->extension = str($extension)->remove(['.']);
    }
}
