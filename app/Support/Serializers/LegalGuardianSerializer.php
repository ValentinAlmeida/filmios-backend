<?php

namespace App\Support\Serializers;

use App\Entities\LegalGuardianEntity;

class LegalGuardianSerializer
{
    public static function parseEntity(LegalGuardianEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'name' => $entity->getName(),
            'cpf' => $entity->getCpf(),
        ];
    }
}
