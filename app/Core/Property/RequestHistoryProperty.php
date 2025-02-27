<?php

namespace App\Core\Property;

use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\UserEntity;
use DateTimeInterface;

class RequestHistoryProperty
{
    public function __construct(
        public ?StatusEstablishmentEnum $statusEnum = null,
        public ?UserEntity $user_approver = null,
        public ?DateTimeInterface $created_at = null,
        public ?string $observation = null,
        public ?DateTimeInterface $term = null,
    ) {
    }
}
