<?php

namespace App\Support\Serializers;

use App\Entities\ActivityEntity;
use App\Entities\EstablishmentEntity;
use App\Entities\OpeningHoursEntity;

class EstablishmentSerializer
{
    public static function parseEntity(EstablishmentEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'is_mei' => $entity->isMei(),
            'company_name' => $entity->getCompanyName(),
            'trade_name' => $entity->getTradeName(),
            'document' => $entity->getDocument(),
            'cga' => $entity->getCga(),
            'telephone' => $entity->getTelephone(),
            'email' => $entity->getEmail(),
            'identification_document_path' => $entity->getIdentificationDocumentPath(),
            'operating_license_path' => $entity->getOperatingLicensePath(),
            'social_contract_path' => $entity->getSocialContractPath(),
            'mei_path' => $entity->getMeiPath(),
            'created_at' => $entity->getCreatedAt(),
            'activities_entity' => array_map(fn (ActivityEntity $activityEntity) => ActivitySerializer::parseEntity($activityEntity), $entity->getActivities()),
            'opening_hours_entity' => array_map(fn (OpeningHoursEntity $openingHoursEntity) => OpeningHoursSerializer::parseEntity($openingHoursEntity), $entity->getOpeningHours()),
            'legal_guardian_entity' => LegalGuardianSerializer::parseEntity($entity->getLegalGuardianEntity()),
            'unit_address_entity' => UnitAddressSerializer::parseEntity($entity->getUnitAddressEntity()),
            'user_entity' => UserSerializer::parseEntityToDomain($entity->getUserEntity()),
            'document_enum' => EnumSerializer::parseIndividualEnum($entity->getDocumentEnum()),
            'status_enum' => EnumSerializer::parseIndividualEnum($entity->getStatusEnum()),
        ];
    }

    public static function parseEntityToDomain(EstablishmentEntity $establishmentEntity)
    {
        return [
            'id' => (int)$establishmentEntity->getIdentifier()->getValue(),
            'company_name' => $establishmentEntity->getCompanyName()
        ];
    }

    public static function parseActivityAndAddress(EstablishmentEntity $entity)
    {
        return [
            'id' => (int)$entity->getIdentifier()->getValue(),
            'activities_entity' => array_map(fn (ActivityEntity $activityEntity) => ActivitySerializer::parseBasicEntity($activityEntity), $entity->getActivities()),
            'unit_address_entity' => UnitAddressSerializer::parseBasicEntity($entity->getUnitAddressEntity()),
            'created_at' => $entity->getCreatedAt(),
        ];
    }
}
