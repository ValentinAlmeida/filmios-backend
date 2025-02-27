<?php

namespace App\Infra;

use App\Infra\FileSystem\Contracts\Path;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Stringable;

class PathStorage implements Path
{
    const DIRECTORY_SEPARATOR = '/';

    private string $path;
    private string $prefix;

    private function __construct(string $path)
    {
        $path = str($path);

        $this->prefix = Storage::path('');

        if (!$path->startsWith($this->prefix)) {
            $path = Storage::path($path);
        }

        $this->path = $path;
    }

    public static function build(string $path = self::DIRECTORY_SEPARATOR)
    {
        return new static ($path);
    }

    public function __toString(): string
    {
        return $this->path;
    }

    public function attach(string $sub): Path
    {
        return static::build(str($this->path)->append(self::DIRECTORY_SEPARATOR, $sub));
    }

    public function exists(): bool
    {
        return Storage::exists($this->relative());
    }

    public function absolute(): string
    {
        return $this->path;
    }

    public function relative(): string
    {
        return str($this->path)->after($this->prefix)->start(self::DIRECTORY_SEPARATOR);
    }

    public function dirname(): string
    {
        return str($this->absolute())->afterLast(self::DIRECTORY_SEPARATOR);
    }

    public static function make(?string $path = null): Path
    {
        return new static($path);
    }

    public function isArchive(): bool
    {
        return is_file($this->absolute());
    }

    public function isDirectory(): ?bool
    {
        return is_dir($this->absolute());
    }

    public function base(): string
    {
        return str($this->absolute())->beforeLast(self::DIRECTORY_SEPARATOR);
    }

    public function directory(): Stringable
    {
        return str($this->base())->afterLast(self::DIRECTORY_SEPARATOR);
    }
}
