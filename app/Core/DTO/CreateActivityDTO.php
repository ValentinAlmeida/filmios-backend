<?php

namespace App\Core\DTO;

use DateTimeInterface;

class CreateActivityDTO
{
    public function __construct(
        public ?DateTimeInterface $start_date = null,
        public ?int $cnaeRef = null,
    ) {}
}
