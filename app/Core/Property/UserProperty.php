<?php

namespace App\Core\Property;

use App\Entities\ProfileEntity;
use DateTimeInterface;

class UserProperty
{
    public function __construct(
        public readonly ?string $login = null,
        public readonly ?string $cpf = null,
        public readonly ?string $password = null,
        public readonly ?string $email = null,
        public readonly ?bool $block = null,
        public readonly ?bool $active = null,
        public ?DateTimeInterface $created_at = null,
        public ?ProfileEntity $profile = null,
        public ?array $localities = null,
        public readonly ?string $name = null,
        public readonly ?string $telephone = null
    ) {
    }
}
