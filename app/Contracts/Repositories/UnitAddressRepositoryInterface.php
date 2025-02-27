<?php

namespace App\Contracts\Repositories;

use App\Entities\UnitAddressEntity;

interface UnitAddressRepositoryInterface
{
   public function create(UnitAddressEntity $unitAddressEntity): int;
}
