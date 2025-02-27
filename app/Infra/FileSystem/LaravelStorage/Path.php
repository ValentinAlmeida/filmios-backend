<?php

namespace App\Infra\FileSystem\LaravelStorage;

use App\Infra\FileSystem\Contracts\Path as Contrato;
use Illuminate\Support\Facades\Storage;

class Path implements Contrato
{
    private ?string $relative;

    private string $base;

    private function __construct(?string $path = null)
    {
        $this->base = Storage::path('');

        if (is_string($path) && str_starts_with($path, $this->base)) {
            $path = Storage::path($path);
        }

        $this->relative = $path;
    }

    public static function make(?string $path = null): static
    {
        return new static($path);
    }

    public function __toString()
    {
        return $this->absolute();
    }

    public function absolute(): string
    {
        $separator = $this->relativeWithSeparator()
            ? '' : DIRECTORY_SEPARATOR;

        return implode($separator, [$this->base, $this->relative()]);
    }

    public function relative(): string
    {
        return $this->relative ?? '';
    }

    public function attach(string $sub): static
    {
        return static::make(implode(DIRECTORY_SEPARATOR, [$this->relative(), $sub]));
    }

    public function exists(): bool
    {
        return file_exists($this->absolute());
    }

    public function isArchive(): bool
    {
        return is_file($this->absolute());
    }

    public function isDirectory(): bool
    {
        return is_dir($this->absolute());
    }

    public function directory(): Path
    {
        return Path::make(dirname($this->absolute()));
    }

    public function base(): string
    {
        return basename($this->absolute());
    }

    public function __clone()
    {
        return static::make($this->relative());
    }

    private function relativeWithSeparator()
    {
        return str_starts_with($this->relative(), DIRECTORY_SEPARATOR);
    }
}
