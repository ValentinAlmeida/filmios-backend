<?php

namespace App\Core\Property;

use App\Entities\CnaeEntity;
use DateTimeInterface;

class ActivityProperty
{
    public function __construct(
        public ?DateTimeInterface $start_date = null,
        public ?CnaeEntity $cnaeEntity = null,
        public ?DateTimeInterface $created_at = null,
    ) {
    }
}
