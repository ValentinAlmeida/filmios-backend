<?php

namespace App\Support\Serializers;

use App\Core\Contracts\EnumInterface;
use App\Core\Enumerations\OpeningHoursEnum;

class EnumSerializer
{
    public static function parseEntity(EnumInterface $entity)
    {
        return [
            'key' => $entity->getKey(),
            'description' => $entity->getDescription(),
        ];
    }
    public static function parseEnum(array $entity)
    {
        return [
            'key' => $entity['value'],
            'description' => $entity['meta']['description'],
        ];
    }
    public static function parseIndividualEnum($entity)
    {
        return [
            'key' => $entity->value,
            'description' => $entity->withMeta()['description'],
        ];
    }
}
