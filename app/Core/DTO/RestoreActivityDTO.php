<?php

namespace App\Core\DTO;

use App\Entities\CnaeEntity;
use DateTimeInterface;

class RestoreActivityDTO
{
    public function __construct(
        public ?DateTimeInterface $start_date = null,
        public ?CnaeEntity $cnaeEntity = null,
        public ?DateTimeInterface $created_at = null,
    ) {}
}
