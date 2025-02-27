<?php

namespace App\Entities\Mapper;

use App\Entities\CnaeEntity;
use App\Models\CnaeModel;

class CnaeMapper
{
    public static function parseModelToEntity(CnaeModel $model)
    {
        return CnaeEntity::create($model->id, $model->code, $model->description);
    }
}
