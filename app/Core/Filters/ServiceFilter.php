<?php

namespace App\Core\Filters;

use App\Core\Filters\Filter;

class ServiceFilter extends Filter
{
    public ?int $establishmentRef = null;
    public ?string $typeServiceKey = null;
    public ?string $uuid = null;
    public ?string $processNumber = null;
}
