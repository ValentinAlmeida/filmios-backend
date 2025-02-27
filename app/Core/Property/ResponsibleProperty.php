<?php

namespace App\Core\Property;

use App\Entities\UserEntity;
use DateTimeInterface;

class ResponsibleProperty
{
    public function __construct(
        public readonly ?int $registration_number = null,
        public readonly ?string $issuing_body = null,
        public readonly ?string $uf = null,
        public readonly ?string $number_advice = null,
        public readonly ?bool $active = null,
        public readonly ?DateTimeInterface $created_at = null,
        public readonly ?string $file_path = null,
        public readonly ?UserEntity $userEntity = null
    ) {
    }
}
