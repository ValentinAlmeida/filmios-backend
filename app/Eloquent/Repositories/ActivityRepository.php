<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\ActivityRepositoryInterface;
use App\Core\Filters\ActivityFilter;
use App\Entities\ActivityEntity;
use App\Entities\Mapper\ActivityMapper;
use App\Models\ActivityModel;
use App\Models\EstablishmentActivityModel;
use App\Models\EstablishmentModel;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function create(ActivityEntity $activityEntity): int
    {
        $model = ActivityModel::create([
            ActivityModel::START_DATE => $activityEntity->getStartDate(),
            ActivityModel::CNAE_ID => $activityEntity->getCnaeRef(),
        ]);

        return $model->id;
    }

    public function search(ActivityFilter $activityFilter): array
    {
        $model = ActivityModel::whereRelation(ActivityModel::ESTABLISHMENT, EstablishmentActivityModel::ESTABLISHMENT_ID, $activityFilter->establishmentRef);

        return $model->get()->map(fn (ActivityModel $activityModel) => ActivityMapper::parseModelToEntity($activityModel))->toArray();
    }
}
