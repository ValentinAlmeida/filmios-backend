<?php

namespace App\Core\DTO;

use DateTimeInterface;

class RestoreUserDTO
{
    public function __construct(
        public readonly ?string $login = null,
        public readonly ?string $password = null,
        public readonly ?string $email = null,
        public readonly ?string $name = null,
        public readonly ?bool $active = null,
        public readonly ?bool $blocked = null,
        public ?DateTimeInterface $created_at = null,
        public ?DateTimeInterface $updated_at = null,
    ) {}
}
