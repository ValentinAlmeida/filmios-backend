<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\OpeningHoursRepositoryInterface;
use App\Entities\OpeningHoursEntity;
use App\Models\OpeningHoursModel;

class OpeningHoursRepository implements OpeningHoursRepositoryInterface
{
    public function create(OpeningHoursEntity $openingHoursEntity): int
    {
        $model = OpeningHoursModel::create([
            OpeningHoursModel::KEY => $openingHoursEntity->getEnum()->value,
            OpeningHoursModel::OPENING_TIME => $openingHoursEntity->getOpeningTime(),
            OpeningHoursModel::CLOSING_TIME => $openingHoursEntity->getClosingTime(),
        ]);

        return $model->id;
    }
}
