<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\UnitAddressRepositoryInterface;
use App\Entities\UnitAddressEntity;
use App\Models\UnitAddressModel;

class UnitAddressRepository implements UnitAddressRepositoryInterface
{
    public function create(UnitAddressEntity $unitAddressEntity): int
    {
        $model = UnitAddressModel::create([
            UnitAddressModel::CEP => $unitAddressEntity->getCep(),
            UnitAddressModel::TYPE_OF_STREET => $unitAddressEntity->getTypeOfStreet(),
            UnitAddressModel::STREET => $unitAddressEntity->getStreet(),
            UnitAddressModel::NUMBER => $unitAddressEntity->getNumber(),
            UnitAddressModel::WITH_NUMBER => $unitAddressEntity->getWithNumber(),
            UnitAddressModel::COMPLEMENT => $unitAddressEntity->getComplement(),
            UnitAddressModel::NEIGHBORHOOD => $unitAddressEntity->getNeighborhood(),
            UnitAddressModel::MUNICIPALITY => $unitAddressEntity->getMunicipality(),
            UnitAddressModel::REFERENCE_POINT => $unitAddressEntity->getReferencePoint(),
        ]);

        return $model->id;
    }
}
