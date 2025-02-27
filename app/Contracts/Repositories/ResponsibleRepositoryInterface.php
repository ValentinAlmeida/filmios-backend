<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\ResponsibleFilter;
use App\Entities\ResponsibleEntity;
use App\Support\Pagination\Pagination;

interface ResponsibleRepositoryInterface
{
   public function search(ResponsibleFilter $responsibleFilter): Pagination;
   public function create(ResponsibleEntity $responsibleEntity): void;
   public function update(int $id, ResponsibleEntity $entity): void;
   public function findById(int $id): ResponsibleEntity;
   public function active(int $id): void;
}
