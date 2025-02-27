<?php

namespace App\Infra\FileSystem\Contracts;

interface ArchiveService
{
    public function save(string $name, Content $content): Archive;

    public function delete(Archive $archive);

    public function deleteByPath(Path $path);

    public function rename(Archive $archive, string $name): Archive;

    public function recovery(Path $path): Archive;

    public function preparePath(string $relativo): Path;
}
