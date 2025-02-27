<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\DomainRepositoryInterface;
use App\Entities\Mapper\CnaeMapper;
use App\Entities\Mapper\DomainMapper;
use App\Models\CnaeModel;
use App\Models\LocalityModel;

class DomainRepository implements DomainRepositoryInterface
{
    public function searchLocalities(): array
    {
        return LocalityModel::get()->map(fn ($model) => DomainMapper::parseModelToEntity($model))->toArray();
    }
    public function searchCnae(): array
    {
        return CnaeModel::get()->map(fn ($model) => CnaeMapper::parseModelToEntity($model))->toArray();
    }
}
