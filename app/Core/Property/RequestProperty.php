<?php

namespace App\Core\Property;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\UserEntity;
use DateTimeInterface;

class RequestProperty
{
    public function __construct(
        public ?StatusEstablishmentEnum $statusEnum = null,
        public ?ProfileEnum $profileEnum = null,
        public ?UserEntity $user_approver = null,
        public ?UserEntity $user_creator = null,
        public ?DateTimeInterface $created_at = null,
        public ?string $observation = null,
        public ?DateTimeInterface $term = null,
    ) {
    }
}
