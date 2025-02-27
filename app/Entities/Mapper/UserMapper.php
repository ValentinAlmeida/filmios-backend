<?php

namespace App\Entities\Mapper;

use App\Core\DTO\RestoreUserDTO;
use App\Entities\UserEntity;
use App\Models\UserModel;
use Carbon\Carbon;

class UserMapper
{
    public static function parseModelToEntity(UserModel $model)
    {
        $restoreUser = new RestoreUserDTO(
            $model->login,
            $model->password,
            $model->email,
            $model->name,
            $model->active,
            $model->block,
            Carbon::create($model->created_at),
            Carbon::create($model->updated_at),
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
            $mixed['login'],
            null,
            $mixed['email'],
            $mixed['name'],
            $mixed['active'],
            $mixed['block'],
            Carbon::create($mixed['created_at']),
            Carbon::create($mixed['updated_at']),
        );

        return UserEntity::restore($restoreUser, $mixed['id']);
    }

    public static function parseRecoveryToEntity(array $mixed)
    {
        return self::restoreUser($mixed);
    }
}
