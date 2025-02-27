<?php

namespace App\Core\DTO;

class UpdateResponsibleDTO
{
    public function __construct(
        public ?int $registration_number = null,
        public ?string $issuing_body = null,
        public ?string $uf = null,
        public ?string $number_advice = null,
        public ?string $file_path = null
    ) {}
}

