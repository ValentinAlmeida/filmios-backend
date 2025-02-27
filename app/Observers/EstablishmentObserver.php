<?php

namespace App\Observers;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Models\EstablishmentModel;
use App\Models\RequestModel;

class EstablishmentObserver
{
    public function created(EstablishmentModel $establishmentModel): void
    {
        $requestModel = RequestModel::create([
            RequestModel::PROFILE_KEY => ProfileEnum::REGULADO->value,
            RequestModel::STATUS_KEY => StatusEstablishmentEnum::PENDENTE_ANALISE->value,
            RequestModel::USER_CREATOR_ID => $establishmentModel->user_id,
            RequestModel::USER_APPROVER_ID => null,
        ]);

        $establishmentModel->request()->attach($requestModel->id);
    }
}
