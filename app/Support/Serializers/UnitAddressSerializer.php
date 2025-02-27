<?php

namespace App\Support\Serializers;

use App\Entities\UnitAddressEntity;

class UnitAddressSerializer
{
    public static function parseEntity(UnitAddressEntity $unitAddressEntity)
    {
        return [
            'id' => (int)$unitAddressEntity->getIdentifier()->getValue(),
            'cep' => $unitAddressEntity->getCep(),
            'typeOfStreet' => $unitAddressEntity->getTypeOfStreet(),
            'street' => $unitAddressEntity->getStreet(),
            'number' => $unitAddressEntity->getNumber(),
            'withNumber' => $unitAddressEntity->getWithNumber(),
            'complement' => $unitAddressEntity->getComplement(),
            'neighborhood' => $unitAddressEntity->getNeighborhood(),
            'municipality' => $unitAddressEntity->getMunicipality(),
            'referencePoint' => $unitAddressEntity->getReferencePoint(),
            'createdAt' => $unitAddressEntity->getCreatedAt(),
        ];
    }
    public static function parseBasicEntity(UnitAddressEntity $unitAddressEntity)
    {
        return [
            'id' => (int)$unitAddressEntity->getIdentifier()->getValue(),
            'street' => $unitAddressEntity->getStreet(),
            'neighborhood' => $unitAddressEntity->getNeighborhood(),
        ];
    }
}
