<?php

namespace App\Support\Serializers;

use App\Entities\FeatureEntity;
use App\Entities\ProfileEntity;

class ProfileSerializer
{
    public static function parseEntity(ProfileEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'description' => $entity->getDescription(),
            'key' => $entity->getKey(),
            'feature' => $entity->getFeature() ? array_map(fn (FeatureEntity $featureEntity) => EnumSerializer::parseEntity($featureEntity), $entity->getFeature()) : null,
        ];
    }
}
