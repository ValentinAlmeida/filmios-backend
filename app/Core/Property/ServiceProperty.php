<?php

namespace App\Core\Property;

use App\Entities\EstablishmentEntity;
use App\Entities\UserEntity;
use DateTimeInterface;

class ServiceProperty
{
    public function __construct(
        public ?string $process_number = null,
        public ?string $type_service_key = null,
        public ?DateTimeInterface $created_at = null,
        public ?EstablishmentEntity $establishmentEntity = null,
        public ?string $link = null,
        public ?string $qr_path = null,
        public ?UserEntity $userEntity = null
    ) {
    }
}
