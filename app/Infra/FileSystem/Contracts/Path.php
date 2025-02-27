<?php

namespace App\Infra\FileSystem\Contracts;

use Illuminate\Support\Stringable as SupportStringable;

interface Path extends \Stringable
{
    public function absolute(): string;

    public function relative(): string;

    public function exists(): bool;

    public function isArchive(): bool;

    public function isDirectory(): ?bool;

    public function base(): string;

    public function directory(): SupportStringable|Path;

    public function attach(string $sub): Path;
}
