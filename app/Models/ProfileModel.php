<?php

namespace App\Models;

class ProfileModel extends Enum
{
    protected $table = 'profiles';

    public function profileFeature()
    {
        return $this->hasMany(ProfileFeatureModel::class, ProfileFeatureModel::PROFILE_KEY, self::KEY);
    }

    public function profileFeatures()
    {
        return $this->belongsToMany(
            FeatureModel::class,
            ProfileFeatureModel::TABLE,
            ProfileFeatureModel::PROFILE_KEY,
            ProfileFeatureModel::FEATURE_KEY,
            self::KEY
        );
    }
}
