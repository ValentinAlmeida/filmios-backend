<?php

namespace App\Support\Serializers;

use App\Entities\ServiceEntity;

class ServiceSerializer
{
    public static function parseBasicEntity(ServiceEntity $entity)
    {
        return [
            'uuid' => $entity->getIdentifier()->getValue(),
            'process_number' => $entity->getProcessNumber(),
            'created_at' => $entity->getCreatedAt(),
            'establishment' => EstablishmentSerializer::parseActivityAndAddress($entity->getEstablishment()),
            'type_service' => EnumSerializer::parseIndividualEnum($entity->getTypeServiceEnum()),
        ];
    }
    public static function parseEntity(ServiceEntity $entity)
    {
        return [
            'uuid' => $entity->getIdentifier()->getValue(),
            'process_number' => $entity->getProcessNumber(),
            'created_at' => $entity->getCreatedAt(),
            'establishment' => EstablishmentSerializer::parseActivityAndAddress($entity->getEstablishment()),
            'type_service' => EnumSerializer::parseIndividualEnum($entity->getTypeServiceEnum()),
            'user' => UserSerializer::parseEntity($entity->getUser()),
            'url' => $entity->getLink(),
            'qr_path' => $entity->getQrPath(),
        ];
    }
}
