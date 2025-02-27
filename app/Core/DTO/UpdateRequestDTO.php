<?php

namespace App\Core\DTO;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use DateTimeInterface;

class UpdateRequestDTO
{
    public function __construct(
        public ?ProfileEnum $profileEnum = null,
        public ?StatusEstablishmentEnum $statusEnum = null,
        public ?int $user_approver_id = null,
        public ?int $user_creator_id = null,
        public ?string $observation = null,
        public ?DateTimeInterface $term = null
    ) {}
}
