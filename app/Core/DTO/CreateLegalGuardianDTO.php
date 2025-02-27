<?php

namespace App\Core\DTO;

class CreateLegalGuardianDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $cpf = null,
    ) {}
}
