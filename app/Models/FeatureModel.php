<?php

namespace App\Models;

class FeatureModel extends Enum
{
    protected $table = 'features';
    const PROFILE_FEATURE = 'profileFeature';

    public function profileFeature()
    {
        return $this->hasMany(ProfileFeatureModel::class, ProfileFeatureModel::FEATURE_KEY, self::KEY);
    }
}
