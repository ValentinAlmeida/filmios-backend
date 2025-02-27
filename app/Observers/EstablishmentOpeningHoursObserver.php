<?php

namespace App\Observers;

use App\Models\EstablishmentOpeningHoursModel;
use App\Models\OpeningHoursModel;

class EstablishmentOpeningHoursObserver
{
    public function deleted(EstablishmentOpeningHoursModel $establishmentOpeningHoursModel): void
    {
        OpeningHoursModel::find($establishmentOpeningHoursModel->opening_hours_id)->delete();
    }

    public function forceDeleted(EstablishmentOpeningHoursModel $establishmentOpeningHoursModel): void
    {
        OpeningHoursModel::find($establishmentOpeningHoursModel->opening_hours_id)->delete();
    }
}
