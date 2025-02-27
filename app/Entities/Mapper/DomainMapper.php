<?php

namespace App\Entities\Mapper;

use App\Entities\DomainEntity;

class DomainMapper
{
    public static function parseModelToEntity($model)
    {
        return DomainEntity::create($model->id, $model->description);
    }
    public static function parseArrayToEntity(array $mixed)
    {
        return array_map(fn (array $locality) => DomainEntity::create($locality['id'], $locality['description']), $mixed);
    }
}
