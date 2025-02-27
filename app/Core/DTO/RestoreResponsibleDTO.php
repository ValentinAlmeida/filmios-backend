<?php

namespace App\Core\DTO;

use App\Entities\UserEntity;
use DateTimeInterface;

class RestoreResponsibleDTO
{
    public function __construct(
        public int $registration_number,
        public string $issuing_body,
        public string $uf,
        public string $number_advice,
        public bool $active,
        public UserEntity $userEntity,
        public DateTimeInterface $created_at,
        public ?string $file_path = null
    ) {}
}
