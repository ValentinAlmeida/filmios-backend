<?php

namespace App\Core\DTO;

use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Entities\LegalGuardianEntity;
use App\Entities\UnitAddressEntity;
use App\Entities\UserEntity;
use DateTimeInterface;

class RestoreEstablishmentDTO
{
    public function __construct(
        public bool $is_mei,
        public string $company_name,
        public string $trade_name,
        public DocumentEnum $documentEnum,
        public string $document,
        public string $cga,
        public UnitAddressEntity $unitAddressEntity,
        public UserEntity $userEntity,
        public string $telephone,
        public string $email,
        public DateTimeInterface $created_at,
        public LegalGuardianEntity $legalGuardianEntity,
        public ?string $identification_document_path = null,
        public ?string $operating_license_path = null,
        public ?string $social_contract_path = null,
        public ?string $mei_path = null,
        public ?array $activities = null,
        public ?array $opening_hours = null,
        public ?StatusEstablishmentEnum $statusEstablishmentEnum = null
    ) {}
}
