<?php

namespace App\Core\DTO;

class UpdateUserDTO
{
    public function __construct(
        public ?string $login = null,
        public ?string $password = null,
        public ?string $email = null,
        public ?bool $active = null,
        public ?bool $blocked = null,
        public ?string $name = null,
    ) {}
}
