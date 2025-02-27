<?php

namespace App\Entities\Mapper;

use App\Constants\Format;
use App\Core\DTO\RestoreOpeningHoursDTO;
use App\Core\Enumerations\OpeningHoursEnum;
use App\Entities\OpeningHoursEntity;
use App\Models\OpeningHoursModel;
use Carbon\Carbon;

class OpeningHoursMapper
{
    public static function parseModelToEntity(OpeningHoursModel $model): OpeningHoursEntity
    {
        $restoreEntity = new RestoreOpeningHoursDTO(
            OpeningHoursEnum::from($model->key),
            $model->opening_time,
            $model->closing_time,
            Carbon::create($model->created_at)
        );

        return OpeningHoursEntity::restore($restoreEntity, $model->id);
    }
}
