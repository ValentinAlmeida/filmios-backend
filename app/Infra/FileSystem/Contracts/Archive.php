<?php

namespace App\Infra\FileSystem\Contracts;

interface Archive
{
    public function getName(): string;

    public function getNameBase(): string;

    public function getExtension(): string;

    public function getContent(): Content;

    public function getPath(): Path;

    public function rename(string $name);

    public function isSaved(): bool;

    public function getTypeMime(): string;
}
