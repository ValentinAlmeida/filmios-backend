<?php

namespace App\Core\DTO;

class CreateUnitAddressDTO
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
    ) {}
}
