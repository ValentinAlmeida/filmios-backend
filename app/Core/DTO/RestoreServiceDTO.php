<?php

namespace App\Core\DTO;

use App\Entities\EstablishmentEntity;
use App\Entities\UserEntity;
use DateTimeInterface;

class RestoreServiceDTO
{
    public function __construct(
        public EstablishmentEntity $establishmentEntity,
        public string $process_number,
        public string $type_service_key,
        public DateTimeInterface $created_at,
        public string $link,
        public string $qr_path,
        public UserEntity $userEntity
    ) {}
}
