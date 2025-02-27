<?php

namespace App\Support\Serializers;

use App\Entities\ActivityEntity;
use App\Models\ActivityModel;

class ActivitySerializer
{
    public static function parseEntity(ActivityEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'start_date' => $entity->getStartDate(),
            'cnaes' => CnaeSerializer::parseEntity($entity->getCnaeEntity()),
        ];
    }
    public static function parseBasicEntity(ActivityEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'cnaes' => CnaeSerializer::parseEntity($entity->getCnaeEntity()),
        ];
    }
}
