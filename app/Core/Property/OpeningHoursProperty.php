<?php

namespace App\Core\Property;

use App\Core\Enumerations\OpeningHoursEnum;
use DateTimeInterface;

class OpeningHoursProperty
{
    public function __construct(
        public ?OpeningHoursEnum $openingHoursEnum = null,
        public ?string $opening_time = null,
        public ?string $closing_time = null,
        public ?DateTimeInterface $created_at = null,
    ) {
    }
}
