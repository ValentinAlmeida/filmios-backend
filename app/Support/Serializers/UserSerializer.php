<?php

namespace App\Support\Serializers;

use App\Entities\DomainEntity;
use App\Entities\UserEntity;

class UserSerializer
{
    public static function parseEntity(UserEntity $user)
    {
        return [
            'id' => (int)$user->getIdentifier()->getValue(),
            'login' => $user->getLogin(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'block' => $user->isBlocked(),
            'active' => $user->isActive(),
            'created_at' => $user->getCreatedAt(),
            'updated_at' => $user->getUpdatedAt()
        ];
    }
    public static function parseEntityDecode(UserEntity $user)
    {
        return [
            'id' => (int)$user->getIdentifier()->getValue(),
            'login' => $user->getLogin(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'block' => $user->isBlocked(),
            'active' => $user->isActive(),
            'created_at' => $user->getCreatedAt(),
            'updated_at' => $user->getUpdatedAt()
        ];
    }
    public static function parseEntityToDomain(UserEntity $user)
    {
        return [
            'id' => (int)$user->getIdentifier()->getValue(),
            'name' => $user->getName(),
            'created_at' => $user->getCreatedAt()
        ];
    }
}
