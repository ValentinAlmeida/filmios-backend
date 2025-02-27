<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateUserDTO;
use App\Core\DTO\UpdateUserDTO;
use App\Core\Filters\UserFilter;
use App\Entities\UserEntity;
use App\Support\Pagination\Pagination;

interface UserServiceInterface
{
    public function create(CreateUserDTO $data): void;

    public function update(int $id, UpdateUserDTO $data): void;

    public function delete(int $id);

    public function search(UserFilter $filter): Pagination;

    public function findById(int $id): UserEntity;

    public function modifyState(int $id): void;
}
