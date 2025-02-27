<?php

namespace App\Support\Serializers;

use App\Core\Contracts\DomainInterface;

class DomainSerializer
{
    public static function parseEntity(DomainInterface $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'description' => $entity->getDescription(),
        ];
    }
}
