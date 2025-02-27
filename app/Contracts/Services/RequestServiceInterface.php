<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateRequestDTO;
use App\Core\DTO\UpdateRequestDTO;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\RequestFilter;
use App\Entities\RequestEntity;
use App\Support\Pagination\Pagination;

interface RequestServiceInterface
{
    public function create(CreateRequestDTO $data): void;

    public function update(int $id, UpdateRequestDTO $data): void;

    public function search(RequestFilter $filter): Pagination;

    public function findById(int $id): RequestEntity;

    public function modifyState(int $id, StatusEstablishmentEnum $statusEnum): void;

    public function searchByUserCreatorId(RequestFilter $requestFilter): Pagination;
}
