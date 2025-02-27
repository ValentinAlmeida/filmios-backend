<?php

namespace App\Core\DTO;

class SearchStatusEstablishmentDTO
{
    public function __construct(
        public readonly ?bool $isEstablishment,
    ) {}
}
