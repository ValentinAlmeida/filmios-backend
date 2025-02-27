<?php

namespace App\Entities\Mapper;

use App\Entities\ProfileEntity;
use App\Models\ProfileFeatureModel;
use App\Models\ProfileModel;

class ProfileMapper
{
    public static function parse(ProfileModel $model)
    {
        return ProfileEntity::create(
            $model->id,
            $model->key,
            $model->profileFeature ? $model->profileFeature()->get()->map(fn(ProfileFeatureModel $profileFeature) => FeatureMapper::parse($profileFeature->feature))->toArray() : null
        );
    }
    public static function parseArrayToEntity(array $mixed)
    {
        return ProfileEntity::create(
            $mixed['id'],
            $mixed['key'],
            $mixed['feature'] ? array_map(fn ($feature) => FeatureMapper::parseArrayToEntity($feature), $mixed['feature']) : null
        );
    }
}
