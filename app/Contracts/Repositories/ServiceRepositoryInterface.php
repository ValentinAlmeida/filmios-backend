<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\ServiceFilter;
use App\Entities\ServiceEntity;

interface ServiceRepositoryInterface
{
   public function create(ServiceEntity $serviceEntity): string;

   public function search(ServiceFilter $filter): array;
}
