<?php

namespace App\Core\DTO;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\UserEntity;
use DateTimeInterface;

class RestoreRequestDTO
{
    public function __construct(
        public readonly ProfileEnum $profileEnum,
        public readonly StatusEstablishmentEnum $statusEnum,
        public readonly ?UserEntity $user_approver,
        public readonly UserEntity $user_creator,
        public readonly DateTimeInterface $created_At,
        public readonly ?string $observation,
        public readonly ?DateTimeInterface $term = null,
    ) {}
}
