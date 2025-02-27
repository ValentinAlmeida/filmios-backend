<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\ActivityFilter;
use App\Entities\ActivityEntity;

interface ActivityRepositoryInterface
{
   public function create(ActivityEntity $activityEntity): int;
   public function search(ActivityFilter $filter): array;
}
