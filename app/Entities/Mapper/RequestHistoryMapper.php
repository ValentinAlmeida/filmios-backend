<?php

namespace App\Entities\Mapper;

use App\Constants\Format;
use App\Core\DTO\RestoreRequestHistoryDTO;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\RequestHistoryEntity;
use App\Models\RequestHistoryModel;
use Carbon\Carbon;

class RequestHistoryMapper
{
    public static function parseModelToEntity(RequestHistoryModel $model)
    {
        $restoreRequest = new RestoreRequestHistoryDTO(
            StatusEstablishmentEnum::from($model->status_establishment_key),
            $model->userApprover ? UserMapper::parseModelToEntity($model->userApprover) : null,
            Carbon::create($model->created_at),
            $model->observation,
            carbon_or_null(null, $model->term),
        );

        return RequestHistoryEntity::restore($restoreRequest, $model->id);
    }
}
