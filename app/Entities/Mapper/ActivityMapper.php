<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreActivityDTO;
use App\Entities\ActivityEntity;
use App\Models\ActivityModel;
use Carbon\Carbon;

class ActivityMapper
{
    public static function parseModelToEntity(ActivityModel $model): ActivityEntity
    {
        $restoreEntity = new RestoreActivityDTO(
            Carbon::create($model->start_date),
            CnaeMapper::parseModelToEntity($model->cnae()->first()),
            Carbon::create($model->created_at)
        );

        return ActivityEntity::restore($restoreEntity, $model->id);
    }
}
