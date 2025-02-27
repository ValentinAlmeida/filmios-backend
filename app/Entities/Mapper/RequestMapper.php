<?php

namespace App\Entities\Mapper;

use App\Constants\Format;
use App\Core\DTO\RestoreRequestDTO;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\RequestEntity;
use App\Models\RequestModel;
use Carbon\Carbon;

class RequestMapper

{
    public static function parseModelToEntity(RequestModel $model)
    {
        $restoreRequest = new RestoreRequestDTO(
            ProfileEnum::from($model->profile_key),
            StatusEstablishmentEnum::from($model->status_establishment_key),
            $model->userApprover ? UserMapper::parseModelToEntity($model->userApprover) : null,
            UserMapper::parseModelToEntity($model->userCreator),
            Carbon::create($model->created_at),
            $model->observation,
            carbon_or_null(null, $model->term),
        );

        return RequestEntity::restore($restoreRequest, $model->id);
    }
}
