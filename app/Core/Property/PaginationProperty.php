<?php

namespace App\Core\Property;

use Illuminate\Support\Collection;

class PaginationProperty
{
    public function __construct(
        public array|Collection|null $entity = null,
        public ?int $data = null,
        public ?int $page = null,
        public ?int $perPage = null,
    ) {
    }
}
