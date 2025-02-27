<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Services\PermissionServiceInterface;
use App\Core\DTO\SearchFeatureDTO;
use App\Core\DTO\SyncFeaturesDTO;
use App\Core\Filters\FeatureFilter;

class PermissionService implements PermissionServiceInterface
{
    public function __construct(private readonly PermissionRepositoryInterface $permissionRepo)
    {
    }

    public function sync(SyncFeaturesDTO $data): void
    {
        $this->permissionRepo->sync($data);
    }

    public function searchFeatures(FeatureFilter $searchFeatureDTO): array
    {
        return $this->permissionRepo->searchFeatures($searchFeatureDTO);
    }

    public function searchProfiles(): array
    {
        return $this->permissionRepo->searchProfiles();
    }
}
