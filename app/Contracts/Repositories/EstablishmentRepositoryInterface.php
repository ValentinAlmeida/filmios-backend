<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\EstablishmentFilter;
use App\Entities\EstablishmentEntity;
use App\Support\Pagination\Pagination;

interface EstablishmentRepositoryInterface
{
    public function create(EstablishmentEntity $data): EstablishmentEntity;

    public function search(EstablishmentFilter $filter): Pagination;

    public function update(int $id, EstablishmentEntity $data);

    public function findById(int $id): EstablishmentEntity;

    public function searchByUserCreatorId(int $userId): array;

    public function active(int $id): void;
}
