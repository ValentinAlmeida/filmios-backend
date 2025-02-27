<?php

namespace App\Entities\Mapper;

use App\Entities\FeatureEntity;
use App\Models\FeatureModel;

class FeatureMapper
{
    public static function parse(FeatureModel $model)
    {
        return FeatureEntity::restore($model->id, $model->key);
    }
    public static function parseArrayToEntity(array $mixed)
    {
        return FeatureEntity::create($mixed['key']);
    }
}
