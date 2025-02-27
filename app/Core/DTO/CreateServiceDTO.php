<?php

namespace App\Core\DTO;

class CreateServiceDTO
{
    public function __construct(
        public int $establishment_id,
        public string $process_number,
        public string $type_service_key,
        public ?string $link = null,
        public ?int $user_id = null,
    ) {}
}
