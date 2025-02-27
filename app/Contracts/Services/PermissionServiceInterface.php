<?php

namespace App\Contracts\Services;

use App\Core\DTO\SyncFeaturesDTO;
use App\Core\Filters\FeatureFilter;

interface PermissionServiceInterface
{
    public function sync(SyncFeaturesDTO $data): void;

    public function searchFeatures(FeatureFilter $searchFeatureDTO): array;
    public function searchProfiles(): array;
}
