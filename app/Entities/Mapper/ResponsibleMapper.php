<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreResponsibleDTO;
use App\Entities\ResponsibleEntity;
use App\Models\ResponsibleModel;
use Carbon\Carbon;

class ResponsibleMapper
{
    public static function parseModelToEntity(ResponsibleModel $model)
    {
        $restoreDTO = new RestoreResponsibleDTO(
            $model->registration_number,
            $model->issuing_body,
            $model->uf,
            $model->number_advice,
            $model->active,
            UserMapper::parseModelToEntity($model->user),
            Carbon::create($model->created_at),
            $model->file_path
        );

        return ResponsibleEntity::restore($model->id, $restoreDTO);
    }
}
