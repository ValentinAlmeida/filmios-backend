<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\RequestFilter;
use App\Entities\RequestEntity;
use App\Support\Pagination\Pagination;

interface RequestRepositoryInterface
{
    public function create(RequestEntity $data): RequestEntity;

    public function search(RequestFilter $filter): Pagination;

    public function update(int $id, RequestEntity $data);

    public function findById(int $id): RequestEntity;
}
