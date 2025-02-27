<?php

namespace App\Core\DTO;

class CreateUserDTO
{
    public function __construct(
        public readonly string $login,
        public readonly ?string $password,
        public readonly string $email,
        public readonly ?bool $active = null,
        public readonly ?bool $blocked = null,
        public readonly ?string $url = null,
        public readonly ?string $name = null
    ) {}
}
