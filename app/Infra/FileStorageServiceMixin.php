<?php

namespace App\Infra;

use App\Infra\FileSystem\Contracts\Archive as ContratoArquivo;
use App\Infra\FileSystem\Contracts\Archive as ContractsArchive;
use App\Infra\FileSystem\Contracts\Content;
use App\Infra\FileSystem\Contracts\Path as ContractsPath;
use App\Infra\FileSystem\Exceptions\ArchiveException;
use App\Infra\FileSystem\LaravelStorage\Archive;
use Illuminate\Support\Facades\File as Facade;

trait FileStorageServiceMixin
{
    private PathStorage $pathBase;

    protected function initializeStorage(string $pathBase)
    {
        $this->pathBase = $this->buildPath($pathBase);

        if (!$this->pathBase->exists()) {
            Facade::makeDirectory($this->pathBase);
        }
    }

    protected function put(PathStorage $path, Content $content)
    {
        if (!Facade::put($path, $content->getLine())) {
            throw new ArchiveException("Falha ao escrever o arquivo", $path);
        }

        return Archive::buildPath($path);
    }

    public function saveArchive(string $name, Content $content): ContratoArquivo
    {
        $extension = $this->getContentExtension($content);
        $path = $this->convertPath($this->convertNameArchive($name, $extension));

        $this->validateIfNotExists($path);

        return $this->put($path, $content);
    }

    protected function getContentExtension(Content $content): string
    {
        $f = finfo_open();

        $extension = $f->buffer($content->getValue(), FILEINFO_EXTENSION);

        if (str($extension)->is(['???', ''])) {
            $extension = 'txt';
        }

        finfo_close($f);

        return $extension;
    }

    protected function convertPath(string $path)
    {
        return $this->pathBase->attach($path);
    }

    protected function validateIfItAlreadyExists(PathStorage $path)
    {
        if ($path->exists()) {
            $this->throwAlredyExists($path);
        }
    }

    protected function validateIfNotExists(PathStorage $path)
    {
        if ($path->exists()) {
            $this->throwNaoEncontrado($path);
        }
    }

    protected function throwAlredyExists(PathStorage $path): never
    {
        throw new ArchiveException('Arquivo já existe', $path);
    }

    protected function throwNotFound(PathStorage $path): never
    {
        throw new ArchiveException('Arquivo não encontrado', $path);
    }

    protected function remove(ContractsPath $path)
    {
        Facade::delete($path);
    }

    public function deleteArchive(ContractsArchive $arquivo)
    {
        $this->deletarArquivoPorCaminho($arquivo->getPath());
    }

    public function deleteArchiveByPath(ContractsPath $path)
    {
        $this->validateIfNotExists($path);

        $this->remove($path);
    }

    public function renameArchive(ContractsArchive $archive, string $name): ContratoArquivo
    {
        if (str($archive->getNameBase())->is($name)) {
            return $archive;
        }

        $newPath = $this->convertPath($this->convertNamePath($name, $archive->getExtension()));

        $this->validateIfItAlreadyExists($newPath);

        if (Facade::move($archive->getPath(), $newPath)) {
            $archive = Archive::buildPath($newPath);
        }

        return $archive;
    }

    public function buildPath(string $path)
    {
        return PathStorage::build($path);
    }

    protected function convertNameArchive(string $name, string $extension)
    {
        return str($name)->append('.', $extension);
    }
}
