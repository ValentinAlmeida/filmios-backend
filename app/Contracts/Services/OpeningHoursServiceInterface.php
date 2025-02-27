<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateOpeningHoursDTO;

interface OpeningHoursServiceInterface
{
    public function create(CreateOpeningHoursDTO $createOpeningHoursDTO): int;
}
