<?php

namespace App\Observers;

use App\Models\ActivityModel;
use App\Models\EstablishmentActivityModel;

class EstablishmentActivityObserver
{
    public function deleted(EstablishmentActivityModel $establishmentActivityModel): void
    {
        ActivityModel::find($establishmentActivityModel->activity_id)->delete();
    }
    public function forceDeleted(EstablishmentActivityModel $establishmentActivityModel): void
    {
        ActivityModel::find($establishmentActivityModel->activity_id)->delete();
    }
}
