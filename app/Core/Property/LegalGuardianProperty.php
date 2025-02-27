<?php

namespace App\Core\Property;

use DateTimeInterface;

class LegalGuardianProperty
{
    public function __construct(
        public ?string $name = null,
        public ?string $cpf = null,
        public ?DateTimeInterface $created_at = null,
    ) {
    }
}
