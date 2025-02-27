<?php

namespace App\Observers;

use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Models\RequestModel;
use App\Models\ResponsibleModel;

class ResponsibleObserver
{
    public function created(ResponsibleModel $responsibleModel): void
    {
        $requestModel = RequestModel::create([
            RequestModel::PROFILE_KEY => ProfileEnum::FISCAL->value,
            RequestModel::STATUS_KEY => StatusEstablishmentEnum::PENDENTE_ANALISE->value,
            RequestModel::USER_CREATOR_ID => $responsibleModel->user_id,
            RequestModel::USER_APPROVER_ID => null,
        ]);

        $responsibleModel->request()->attach($requestModel->id);
    }
}
