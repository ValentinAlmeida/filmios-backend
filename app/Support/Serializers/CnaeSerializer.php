<?php

namespace App\Support\Serializers;

use App\Entities\CnaeEntity;

class CnaeSerializer
{
    public static function parseEntity(CnaeEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'code' => $entity->getCode(),
            'description' => $entity->getDescription(),
        ];
    }
}
