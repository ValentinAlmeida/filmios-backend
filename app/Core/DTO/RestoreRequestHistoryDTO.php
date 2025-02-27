<?php

namespace App\Core\DTO;

use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\UserEntity;
use DateTimeInterface;

class RestoreRequestHistoryDTO
{
    public function __construct(
        public readonly StatusEstablishmentEnum $statusEnum,
        public readonly ?UserEntity $user_approver,
        public readonly DateTimeInterface $created_At,
        public readonly ?string $observation,
        public readonly ?DateTimeInterface $term,
    ) {}
}
