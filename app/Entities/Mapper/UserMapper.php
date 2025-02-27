<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreUserDTO;
use App\Entities\DomainEntity;
use App\Entities\UserEntity;
use App\Models\LocalityModel;
use App\Models\UserModel;
use Carbon\Carbon;

class UserMapper
{
    public static function parseModelToEntity(UserModel $model)
    {
        $restoreUser = new RestoreUserDTO(
            $model->login,
            $model->cpf,
            $model->password,
            $model->email,
            $model->profile ? ProfileMapper::parse($model->profile) : null,
            $model->localities ? $model->localities()->get()->map(fn (LocalityModel $localityModel) => DomainEntity::create($localityModel->id, $localityModel->description))->toArray() : null,
            $model->active,
            $model->block,
            Carbon::create($model->created_at),
            $model->name,
            $model->telephone
        );

        return UserEntity::restore($restoreUser, $model->id);
    }

    public static function parseArrayToEntity(array $mixed)
    {
        $mixed = $mixed['user'];

        return self::restoreUser($mixed);
    }

    private static function restoreUser(array $mixed): UserEntity
    {
        $restoreUser = new RestoreUserDTO(
            null,
            null,
            null,
            null,
            empty($mixed['profile']) ? null : ProfileMapper::parseArrayToEntity($mixed['profile']),
            empty($mixed['localities']) ? null : DomainMapper::parseArrayToEntity($mixed['localities']),
            $mixed['active'],
            $mixed['block'],
            Carbon::create($mixed['created_at']),
            null,
            null,
        );

        return UserEntity::restore($restoreUser, $mixed['id']);
    }

    public static function parseRecoveryToEntity(array $mixed)
    {
        return self::restoreUser($mixed);
    }
}
