<?php

namespace App\Core\Property;

use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\LegalGuardianEntity;
use App\Entities\UnitAddressEntity;
use App\Entities\UserEntity;
use DateTimeInterface;

class EstablishmentProperty
{
    public function __construct(
        public readonly ?bool $is_mei = null,
        public readonly ?string $company_name = null,
        public readonly ?string $trade_name = null,
        public readonly ?DocumentEnum $documentEnum = null,
        public readonly ?string $document = null,
        public readonly ?string $cga = null,
        public readonly ?UnitAddressEntity $unitAddressEntity = null,
        public readonly ?UserEntity $userEntity = null,
        public readonly ?string $telephone = null,
        public readonly ?string $email = null,
        public readonly ?string $identification_document_path = null,
        public readonly ?string $operating_license_path = null,
        public readonly ?string $social_contract_path = null,
        public readonly ?string $mei_path = null,
        public readonly ?LegalGuardianEntity $legalGuardianEntity = null,
        public readonly ?array $activities = null,
        public readonly ?array $opening_hours = null,
        public ?DateTimeInterface $created_at = null,
        public ?StatusEstablishmentEnum $statusEstablishmentEnum = null,
        public ?array $activitiesRef = null,
        public ?array $openingHoursRef = null,
    ) {
    }
}
