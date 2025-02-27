<?php

namespace App\Core\DTO;

use App\Entities\UserEntity;

class CreateResponsibleDTO
{
    public function __construct(
        public int $registration_number,
        public string $issuing_body,
        public string $uf,
        public string $number_advice,
        public UserEntity $userEntity,
        public ?string $file_path = null,
        public ?bool $activity = null
    ) {}
}
