<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreLegalGuardianDTO;
use App\Entities\LegalGuardianEntity;
use App\Models\LegalGuardianModel;
use Carbon\Carbon;

class LegalGuardianMapper
{
    public static function parseModelToEntity(LegalGuardianModel $model)
    {
        $restoreEntity = new RestoreLegalGuardianDTO(
            $model->name,
            $model->cpf,
            Carbon::create($model->created_at)
        );

        return LegalGuardianEntity::restore($restoreEntity, $model->id);
    }
}
