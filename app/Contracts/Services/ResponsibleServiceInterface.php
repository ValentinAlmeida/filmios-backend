<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateResponsibleDTO;
use App\Core\DTO\UpdateResponsibleDTO;
use App\Core\Filters\ResponsibleFilter;
use App\Entities\ResponsibleEntity;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;
use App\Support\Pagination\Pagination;

interface ResponsibleServiceInterface
{
    public function create(CreateResponsibleDTO $createResponsibleDTO): void;
    public function search(ResponsibleFilter $filter): Pagination;
    public function findById(int $id): ResponsibleEntity;
    public function active(int $id): void;
    public function update(int $id, UpdateResponsibleDTO $updateResponsibleDTO): void;
    public function buildArchive(?UTF8Content $contentArchive, int $id): void;
}
