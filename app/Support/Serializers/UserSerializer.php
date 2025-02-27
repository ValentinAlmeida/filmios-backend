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
            'cpf' => $user->getCpf(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'telephone' => $user->getTelephone(),
            'block' => $user->isBlocked(),
            'active' => $user->isActive(),
            'localities' => $user->getLocalities() ? array_map(fn (DomainEntity $locality) => DomainSerializer::parseEntity($locality), $user->getLocalities()) : null,
            'profile' => $user->getProfile() ? EnumSerializer::parseEntity($user->getProfile()) : null,
            'created_at' => $user->getCreatedAt()
        ];
    }
    public static function parseEntityDecode(UserEntity $user)
    {
        return [
            'id' => (int)$user->getIdentifier()->getValue(),
            'block' => $user->isBlocked(),
            'active' => $user->isActive(),
            'localities' => $user->getLocalities() ? array_map(fn (DomainEntity $locality) => DomainSerializer::parseEntity($locality), $user->getLocalities()) : null,
            'profile' => $user->getProfile() ? ProfileSerializer::parseEntity($user->getProfile()) : null,
            'created_at' => $user->getCreatedAt()
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
