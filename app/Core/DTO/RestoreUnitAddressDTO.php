<?php

namespace App\Core\DTO;

use DateTimeInterface;

class RestoreUnitAddressDTO
{
    public function __construct(
        public ?string $cep = null,
        public ?string $typeOfStreet = null,
        public ?string $street = null,
        public ?int $number = null,
        public ?bool $withNumber = null,
        public ?string $complement = null,
        public ?string $neighborhood = null,
        public ?string $municipality = null,
        public ?string $referencePoint = null,
        public ?DateTimeInterface $created_at = null,
    ) {}
}
