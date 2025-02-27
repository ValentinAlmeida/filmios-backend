<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreServiceDTO;
use App\Entities\ServiceEntity;
use App\Models\ServiceModel;
use Carbon\Carbon;

class ServiceMapper
{
    public static function parse(ServiceModel $model)
    {
        $restoreDTO = new RestoreServiceDTO(
            EstablishmentMapper::parseModelToEntity($model->establishment()->first()),
            $model->process_number,
            $model->type_service_key,
            Carbon::create($model->created_at),
            $model->link,
            $model->qr_path,
            UserMapper::parseModelToEntity($model->user()->first()),
        );

        return ServiceEntity::restore($restoreDTO, $model->uuid);
    }
}
