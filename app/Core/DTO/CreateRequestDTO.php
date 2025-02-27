<?php

namespace App\Core\DTO;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use DateTimeInterface;

class CreateRequestDTO
{
    public function __construct(
        public readonly ProfileEnum $profileEnum,
        public readonly StatusEstablishmentEnum $statusEnum,
        public readonly ?int $user_approver_id,
        public readonly int $user_creator_id,
        public readonly ?string $observation,
        public readonly ?DateTimeInterface $term
    ) {}
}
