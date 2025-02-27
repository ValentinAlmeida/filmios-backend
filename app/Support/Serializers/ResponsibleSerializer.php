<?php

namespace App\Support\Serializers;

use App\Entities\ResponsibleEntity;

class ResponsibleSerializer
{
    public static function parseEntity(ResponsibleEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'file_path' => $entity->getFilePath(),
            'nome' => $entity->getUser()->getName(),
            'cpf' => $entity->getUser()->getCpf(),
            'issuing_body' => $entity->getIssuingBody(),
            'uf' => $entity->getUf(),
            'number_advice' => $entity->getNumberAdvice(),
            'active' => $entity->getActive(),
            'registration_number' => $entity->getRegistrationNumber(),
            'user' => UserSerializer::parseEntityToDomain($entity->getUser())
        ];
    }
}
