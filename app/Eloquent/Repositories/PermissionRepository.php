<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Core\DTO\SyncFeaturesDTO;
use App\Core\Filters\FeatureFilter;
use App\Entities\Mapper\FeatureMapper;
use App\Entities\Mapper\ProfileMapper;
use App\Exceptions\ProfileException;
use App\Models\FeatureModel;
use App\Models\ProfileFeatureModel;
use App\Models\ProfileModel;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function sync(SyncFeaturesDTO $data): void
    {
        $profile = ProfileModel::where(ProfileModel::KEY, $data->profile_key)->first();

        throw_if(empty($profile), ProfileException::notFound());

        $profile->profileFeatures()->sync($data->features);
    }

    public function searchFeatures(FeatureFilter $filter): array
    {
        $model = FeatureModel::query();

        $model->when($filter->hasProfileKey(), fn ($q) =>
            $q->whereRelation(FeatureModel::PROFILE_FEATURE, ProfileFeatureModel::PROFILE_KEY, '=', $filter->profileKey)
        );

        return $model->get()->map(fn(FeatureModel $featureModel) => FeatureMapper::parse($featureModel))->toArray();
    }

    public function searchProfiles(): array
    {
        return ProfileModel::get()->map(fn(ProfileModel $profileModel) => ProfileMapper::parse($profileModel))->toArray();
    }
}
