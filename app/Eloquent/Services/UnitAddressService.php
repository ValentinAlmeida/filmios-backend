<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\UnitAddressRepositoryInterface;
use App\Contracts\Services\UnitAddressServiceInterface;
use App\Core\DTO\CreateUnitAddressDTO;
use App\Entities\UnitAddressEntity;

class UnitAddressService implements UnitAddressServiceInterface
{
    public function __construct(private readonly UnitAddressRepositoryInterface $unitAddressRepositoryInterface)
    {
    }

    public function create(CreateUnitAddressDTO $createUnitAddressDTO): int
    {
        return $this->unitAddressRepositoryInterface->create(UnitAddressEntity::create($createUnitAddressDTO));
    }
}
