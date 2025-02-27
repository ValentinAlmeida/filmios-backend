<?php

namespace App\Core\VO;

final class Credential
{
    private function __construct(
        public readonly string $login,
        public readonly string $password
    ) {}

    public static function create(string $login, string $password): static
    {
        return new static($login, $password);
    }
}
