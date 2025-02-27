<?php

namespace App\Core\DTO;

class CreateUserDTO
{
    public function __construct(
        public readonly string $login,
        public readonly string $cpf,
        public readonly ?string $password,
        public readonly string $email,
        public readonly ?string $profileRef,
        public readonly ?array $localitiesRef,
        public readonly ?bool $active = null,
        public readonly ?bool $blocked = null,
        public readonly ?string $url = null,
        public readonly ?string $name = null,
        public readonly ?string $telephone = null,
    ) {}
}
