<?php

namespace App\Core\DTO;

use App\Core\Enumerations\OpeningHoursEnum;
use DateTimeInterface;

class RestoreOpeningHoursDTO
{
    public function __construct(
        public ?OpeningHoursEnum $openingHoursEnum = null,
        public ?string $opening_time = null,
        public ?string $closing_time = null,
        public ?DateTimeInterface $created_at = null,
    ) {}
}
