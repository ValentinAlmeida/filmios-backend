<?php

namespace App\Core\DTO;

use App\Core\Enumerations\OpeningHoursEnum;
use Carbon\Carbon;

class CreateOpeningHoursDTO
{
    public function __construct(
        public ?OpeningHoursEnum $openingHoursEnum,
        public ?string $opening_time,
        public ?string $closing_time,
    ) {}
}
