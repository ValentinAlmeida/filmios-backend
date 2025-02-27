<?php

namespace App\Models;

class ProfileFeatureModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'profile_feature';
    const PROFILE_KEY = 'profile_key';
    const FEATURE_KEY = 'feature_key';

    protected $fillable = [
        self::PROFILE_KEY,
        self::FEATURE_KEY,
    ];

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class, self::PROFILE_KEY, ProfileModel::KEY);
    }

    public function feature()
    {
        return $this->belongsTo(FeatureModel::class, self::FEATURE_KEY, FeatureModel::KEY);
    }
}
