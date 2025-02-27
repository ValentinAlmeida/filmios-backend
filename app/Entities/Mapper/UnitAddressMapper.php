<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreUnitAddressDTO;
use App\Entities\UnitAddressEntity;
use App\Models\UnitAddressModel;
use Carbon\Carbon;

class UnitAddressMapper
{
    public static function parseModelToEntity(UnitAddressModel $model)
    {
        $restoreRequest = new RestoreUnitAddressDTO(
            $model->cep,
            $model->type_of_street,
            $model->street,
            $model->number,
            $model->with_number,
            $model->complement,
            $model->neighborhood,
            $model->municipality,
            $model->reference_point,
            Carbon::create($model->created_at),
        );

        return UnitAddressEntity::restore($restoreRequest, $model->id);
    }
}
