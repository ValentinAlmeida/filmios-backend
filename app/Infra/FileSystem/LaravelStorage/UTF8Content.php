<?php

namespace App\Infra\FileSystem\LaravelStorage;

use App\Infra\FileSystem\Contracts\Content;
use Illuminate\Support\Str;

class UTF8Content implements Content
{
    private function __construct(private string $Content)
    {
    }

    public static function makeFromBase64(string $base64): Content
    {
        return new static(base64_decode($base64));
    }

    public static function make(string $valor)
    {
        return new static($valor);
    }

    public function getValue(): string
    {
        return utf8_encode($this->getLine());
    }

    public function getLine(): string
    {
        return $this->Content;
    }

    public function extension(): string
    {
        $f = finfo_open();

        $extensao = $f->buffer($this->getValue(), FILEINFO_EXTENSION);

        if (Str::is(['???', ''], $extensao)) {
            $extensao = 'txt';
        }

        finfo_close($f);

        return $extensao;
    }
}
