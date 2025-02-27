<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateEstablishmentDTO;
use App\Core\DTO\UpdateArchiveEstablishmentDTO;
use App\Core\DTO\UpdateEstablishmentDTO;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\EstablishmentFilter;
use App\Entities\EstablishmentEntity;
use App\Infra\FileSystem\Contracts\Archive;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;
use App\Support\Pagination\Pagination;

interface EstablishmentServiceInterface
{
    public function create(CreateEstablishmentDTO $data): void;

    public function update(int $id, UpdateEstablishmentDTO $data): void;

    public function search(EstablishmentFilter $filter): Pagination;

    public function findById(int $id): EstablishmentEntity;

    public function modifyState(int $id, StatusEstablishmentEnum $statusEnum): void;

    public function searchByUserCreatorId(): array;

    public function active(int $id): void;

    public function updatePath(int $id, UpdateArchiveEstablishmentDTO $updateDTO): void;

    public function saveArchivePattern(int $random, ?UTF8Content $content): ?Archive;
}
