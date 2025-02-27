<?php

namespace App\Infra\FileSystem\Contracts;

interface Content
{
    public static function makeFromBase64(string $base64): Content;

    public function getValue(): string;

    public function getLine(): string;

    public function extension(): string;
}
