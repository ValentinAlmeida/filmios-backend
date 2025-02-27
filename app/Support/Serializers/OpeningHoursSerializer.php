<?php

namespace App\Support\Serializers;

use App\Entities\OpeningHoursEntity;
use App\Models\OpeningHoursModel;

class OpeningHoursSerializer
{
    public static function parseEntity(OpeningHoursEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'enum' => EnumSerializer::parseIndividualEnum($entity->getEnum()),
            'opening_time' => $entity->getOpeningTime(),
            'closing_time' => $entity->getClosingTime(),
        ];
    }
}
