<?php

namespace App\Contracts\Repositories;

use App\Core\DTO\RecoveryPasswordDTO;
use App\Core\DTO\ResetPasswordDTO;
use App\Core\Filters\UserFilter;
use App\Entities\UserEntity;
use App\Support\Pagination\Pagination;

interface UserRepositoryInterface
{
    public function create(UserEntity $data): UserEntity;

    public function search(UserFilter $filter): Pagination;

    public function update(int $id, UserEntity $data);

    public function delete(int $id): void;

    public function block(int $id): void;

    public function unblock(int $id): void;

    public function findById(int $id): UserEntity;

    public function recoverPassword(RecoveryPasswordDTO $recoveryPasswordDTO);
    public function resetPassword(ResetPasswordDTO $resetPasswordDTO, UserEntity $userEntity);
}
