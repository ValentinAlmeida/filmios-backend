<?php

namespace App\Core\DTO;

use DateTimeInterface;

class RestoreLegalGuardianDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $cpf = null,
        public ?DateTimeInterface $created_at = null,
    ) {}
}
