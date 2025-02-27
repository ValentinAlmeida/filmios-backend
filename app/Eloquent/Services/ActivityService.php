<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\ActivityRepositoryInterface;
use App\Contracts\Services\ActivityServiceInterface;
use App\Core\DTO\CreateActivityDTO;
use App\Core\Filters\ActivityFilter;
use App\Entities\ActivityEntity;

class ActivityService implements ActivityServiceInterface
{
    public function __construct(private readonly ActivityRepositoryInterface $activityRepositoryInterface)
    {
    }

    public function create(CreateActivityDTO $createActivityDTO): int
    {
        return $this->activityRepositoryInterface->create(ActivityEntity::create($createActivityDTO));
    }

    public function search(ActivityFilter $activityFilter): array
    {
        return $this->activityRepositoryInterface->search($activityFilter);
    }
}
