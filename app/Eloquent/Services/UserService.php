<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Core\Contracts\UnitOfWorkInterface;
use App\Core\DTO\CreateUserDTO;
use App\Core\DTO\UpdateUserDTO;
use App\Core\Filters\UserFilter;
use App\Entities\UserEntity;
use App\Support\Pagination\Pagination;
use Illuminate\Support\Facades\App;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepo)
    {
    }

    public function create(CreateUserDTO $data): void
    {
        $unitOfWork = App::make(UnitOfWorkInterface::class);
        $user = UserEntity::create($data);

        $unitOfWork->run(fn(): UserEntity => $this->userRepo->create($user));
    }

    public function update(int $id, UpdateUserDTO $data): void
    {
        $usuario = $this->userRepo->findById($id);

        $createUser = new CreateUserDTO(
            $data->login ?? $usuario->getLogin(),
            $data->password ?? $usuario->getPassword(),
            $data->email ?? $usuario->getEmail(),
            $data->active ?? $usuario->isActive(),
            $data->blocked ?? $usuario->isBlocked(),
            null,
            $data->name ?? $usuario->getName(),
        );

        $this->userRepo->update($id, UserEntity::create($createUser));
    }

    public function delete(int $id)
    {
        $this->userRepo->delete($id);
    }

    public function search(UserFilter $filter): Pagination
    {
        return $this->userRepo->search($filter);
    }

    public function findById(int $id): UserEntity
    {
        return $this->userRepo->findById($id);
    }

    public function modifyState(int $id): void
    {
        $user = $this->findById($id);
        $updateDTO = new UpdateUserDTO();

        $updateDTO->active = !$user->isActive();

        $this->update($id, $updateDTO);
    }
}
