<?php

namespace App\Core\Contracts;

use \DateTimeInterface;

interface Token
{
    public function getExpiration(): DateTimeInterface;

    public function getType(): string;

    public function toString(): string;

    public static function parseForStatic(string $token): self;
}
