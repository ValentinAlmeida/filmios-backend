<?php

namespace App\Core\DTO;

class UpdateUserDTO
{
    public function __construct(
        public ?string $login = null,
        public ?string $cpf = null,
        public ?string $password = null,
        public ?string $email = null,
        public ?string $profileRef = null,
        public ?array $localitiesRef = null,
        public ?bool $active = null,
        public ?bool $blocked = null,
        public ?string $name = null,
        public ?string $telephone = null,
    ) {}
}
