<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateActivityDTO;
use App\Core\Filters\ActivityFilter;

interface ActivityServiceInterface
{
    public function create(CreateActivityDTO $createActivityDTO): int;

    public function search(ActivityFilter $activityFilter): array;
}
