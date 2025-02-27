<?php

namespace App\Contracts\Repositories;

use App\Core\DTO\SyncFeaturesDTO;
use App\Core\Filters\FeatureFilter;

interface PermissionRepositoryInterface
{
    public function sync(SyncFeaturesDTO $data);
    public function searchFeatures(FeatureFilter $searchFeatureDTO): array;
    public function searchProfiles(): array;
}
