<?php

namespace App\Infra\Services;

use App\Infra\FileSystem\Contracts\Archive;
use App\Infra\FileSystem\Contracts\Path;
use App\Infra\FileSystem\Contracts\ArchiveService as Contrato;
use App\Infra\FileSystem\Exceptions\ArchiveException;
use App\Infra\FileSystem\LaravelStorage\Archive as ArchiveLaravelStorage;
use App\Infra\FileSystem\LaravelStorage\Path as PathLaravelStorage;
use App\Infra\FileSystem\Contracts\Content;

class DeliveryFileService implements Contrato
{
    private Path $directoryBase;

    public function __construct()
    {
        $this->directoryBase = PathLaravelStorage::make();
    }

    public function preparePath(string $relative): Path
    {
        return $this->directoryBase->attach($relative);
    }

    public function get(Path $path): Archive
    {
        return ArchiveLaravelStorage::load($path);
    }

    public function save(string $name, Content $content): Archive
    {
        $directory = clone $this->directoryBase;

        $archive = ArchiveLaravelStorage::new($name, $directory, $content);

        $this->writeArchive($archive);

        return $archive;
    }

    public function delete(Archive $archive)
    {
        //
    }

    public function deleteByPath(Path $path)
    {
        //
    }

    public function rename(Archive $archive, string $name): Archive
    {
        $baseNameEquality = strcmp($archive->getName(), $name) === 0;
        $nameEquality = strcmp($archive->getName(), $name) === 0;

        if (!$baseNameEquality && !$nameEquality) {
            $archive->rename($name);
        }

        if (!$archive->isSaved()) {
            $this->writeArchive($archive);
        }

        return $archive;
    }

    public function recovery(Path $path): Archive
    {
        if ($path->isArchive()) {
            throw ArchiveException::notFound($path);
        }

        return ArchiveLaravelStorage::load($path);
    }

    private function writeArchive(Archive $archive)
    {
        if (!$archive->isSaved()) {
            $this->createDirectory($archive->getPath()->directory());
        }

        file_put_contents($archive->getPath(), $archive->getContent()->getValue());
    }

    private function createDirectory(Path $directory)
    {
        if (!$directory->isDirectory()) {
            mkdir($directory, 0755);
        }
    }
}
