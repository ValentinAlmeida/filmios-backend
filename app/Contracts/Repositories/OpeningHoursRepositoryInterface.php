<?php

namespace App\Contracts\Repositories;

use App\Entities\OpeningHoursEntity;

interface OpeningHoursRepositoryInterface
{
   public function create(OpeningHoursEntity $openingHoursEntity): int;
}
