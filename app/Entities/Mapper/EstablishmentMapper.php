<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreEstablishmentDTO;
use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\EstablishmentEntity;
use App\Models\ActivityModel;
use App\Models\EstablishmentModel;
use App\Models\OpeningHoursModel;
use Carbon\Carbon;

class EstablishmentMapper
{
    public static function parseModelToEntity(EstablishmentModel $model)
    {
        $restoreEstablishment = new RestoreEstablishmentDTO(
            $model->is_mei,
            $model->company_name,
            $model->trade_name,
            enum_or_null(DocumentEnum::class, $model->key_document),
            $model->document,
            $model->cga,
            map_or_null(UnitAddressMapper::class, $model->unitAddress()->first()),
            map_or_null(UserMapper::class, $model->user()->first()),
            $model->telephone,
            $model->email,
            Carbon::create($model->created_at),
            map_or_null(LegalGuardianMapper::class, $model->legalGuardian()->first()),
            $model->identification_document_path,
            $model->operating_license_path,
            $model->social_contract_path,
            $model->mei_path,
            $model->activity()->get()->map(fn (ActivityModel $activityModel) => ActivityMapper::parseModelToEntity($activityModel))->toArray(),
            $model->openingHours()->get()->map(fn (OpeningHoursModel $openingHoursModel) => OpeningHoursMapper::parseModelToEntity($openingHoursModel))->toArray(),
            enum_or_null(StatusEstablishmentEnum::class, $model->key_status),
        );

        return EstablishmentEntity::restore($restoreEstablishment, $model->id);
    }
}
