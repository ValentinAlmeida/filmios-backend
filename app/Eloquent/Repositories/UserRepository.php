<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Core\DTO\RecoveryPasswordDTO;
use App\Core\DTO\ResetPasswordDTO;
use App\Core\Filters\UserFilter;
use App\Core\VO\TokenJwt;
use App\Entities\Mapper\UserMapper;
use App\Entities\UserEntity;
use App\Exceptions\AuthenticationException;
use App\Exceptions\UserException;
use App\Infra\Helpers\RandomHelper;
use App\Jobs\SendPasswordJob;
use App\Models\UserModel;
use App\Support\Pagination\Pagination;
use App\Support\Serializers\UserSerializer;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $data): UserEntity
    {
        $password = RandomHelper::getNewPassword();

        $userModel = UserModel::create([
            UserModel::CPF => $data->getCpf(),
            UserModel::NAME => $data->getName(),
            UserModel::EMAIL => $data->getEmail(),
            UserModel::PROFILE_KEY => $data->getProfileRef(),
            UserModel::TELEPHONE => $data->getTelephone(),
            UserModel::LOGIN => $data->getLogin(),
            UserModel::PASSWORD => Hash::make($password),
            UserModel::ACTIVE => $data->getProfileRef() ? 1 : 0,
            UserModel::BLOCK => 0,
        ]);

        $userModel->localities()->attach($data->getLocalitiesRef());

        $token = TokenJwt::generate('recovery_password', UserSerializer::parseEntityDecode(UserMapper::parseModelToEntity($userModel)));

        dispatch(new SendPasswordJob($userModel, $data->getUrl(), $password, $token->toString()));

        return UserMapper::parseModelToEntity($userModel);
    }

    public function search(UserFilter $filter): Pagination
    {
        $query = UserModel::query();

        if ($filter->hasCpf()) {
            $query = $query->whereLike(UserModel::CPF, like($filter->cpf));
        }

        if ($filter->hasProfileKey()) {
            $query = $query->whereLike(UserModel::PROFILE_KEY, like($filter->profileKey));
        }

        if ($filter->hasLogin()) {
            $query = $query->whereLike(UserModel::LOGIN, like($filter->login));
        }

        if ($filter->hasEmail()) {
            $query = $query->whereLike(UserModel::EMAIL, like($filter->email));
        }

        if ($filter->hasTelephone()) {
            $query = $query->whereLike(UserModel::TELEPHONE, like($filter->telephone));
        }

        if ($filter->hasBlock()) {
            $query = $query->where(UserModel::BLOCK, $filter->block);
        }

        if ($filter->hasActive()) {
            $query = $query->where(UserModel::ACTIVE, $filter->active);
        }

        if ($filter->hasName()) {
            $query = $query->whereLike(UserModel::NAME, like($filter->name));
        }

        if ($filter->hasStartDate()) {
            $query = $query->whereDate(UserModel::CREATED_AT, '>=', $filter->startDate);
        }

        if ($filter->hasEndDate()) {
            $query = $query->whereDate(UserModel::CREATED_AT, '<=', $filter->endDate);
        }

        $query = $query->orderByRaw(UserModel::NAME);

        $page = $filter->page;
        $perPage = $filter->perPage;

        $data = $query->count();

        $query->skip(($page - 1) * $perPage)->take($perPage);

        return Pagination::create(
            $query->get()->map(fn (UserModel $model) => UserMapper::parseModelToEntity($model))->toArray(),
            $data,
            $page,
            $perPage
        );
    }

    public function update(int $id, UserEntity $data): void
    {
        $user = UserModel::find($id);

        throw_if(!$user, UserException::notFound());

        $user->update([
            UserModel::CPF => $data->getCpf(),
            UserModel::EMAIL => $data->getEmail(),
            UserModel::PROFILE_KEY => $data->getProfileRef(),
            UserModel::LOGIN => $data->getLogin(),
            UserModel::ACTIVE => $data->isActive(),
            UserModel::BLOCK => $data->isBlocked(),
            UserModel::TELEPHONE => $data->getTelephone(),
            UserModel::PASSWORD => $data->getPassword(),
            UserModel::NAME => $data->getName(),
        ]);

        $user->localities()->sync($data->getLocalitiesRef());
    }

    public function delete(int $id): void
    {
        $model = UserModel::find($id);

        throw_if(!$model, UserException::notFound());

        UserModel::find($id)->delete();
    }

    public function block(int $id): void
    {
        $user = UserModel::find($id);

        throw_if(!$user, UserException::notFound());

        $user->block = true;

        $user->save();
    }

    public function unblock(int $id): void
    {
        $user = UserModel::find($id);

        throw_if(!$user, UserException::notFound());

        $user->block = false;

        $user->save();
    }

    public function findById(int $id): UserEntity
    {
        $model = UserModel::find($id);

        throw_if(!$model, UserException::notFound());

        return UserMapper::parseModelToEntity($model);
    }

    public function recoverPassword(RecoveryPasswordDTO $recoveryPasswordDTO)
    {
        $user = UserModel::where(UserModel::EMAIL, $recoveryPasswordDTO->email)->first();

        throw_if(empty($user), AuthenticationException::credentialsInvalid());

        $newPassword = RandomHelper::getNewPassword();
        $user->password = Hash::make($newPassword);

        $user->update();

        $token = TokenJwt::generate('recovery_password', UserSerializer::parseEntityDecode(UserMapper::parseModelToEntity($user)));

        dispatch(new SendPasswordJob($user, $recoveryPasswordDTO->url, $newPassword, $token->toString()));
    }

    public function resetPassword(ResetPasswordDTO $resetPasswordDTO, UserEntity $user)
    {
        $userModel = UserModel::find((int)$user->getIdentifier()->getValue());

        $userModel->password = Hash::make($resetPasswordDTO->password);

        $userModel->update();
    }
}
