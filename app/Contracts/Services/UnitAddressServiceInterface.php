<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateUnitAddressDTO;

interface UnitAddressServiceInterface
{
    public function create(CreateUnitAddressDTO $createUnitAddressDTO): int;
}
