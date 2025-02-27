<?php

namespace App\Core\DTO;

class UpdateEstablishmentDTO
{
    public function __construct(
        public ?bool $is_mei = null,
        public ?string $company_name = null,
        public ?string $trade_name = null,
        public ?string $documentKey = null,
        public ?string $document = null,
        public ?string $cga = null,
        public ?int $unitAddressRef = null,
        public ?int $userRef = null,
        public ?string $telephone = null,
        public ?string $email = null,
        public ?int $legalGuardianRef = null,
        public ?array $activities = null,
        public ?array $opening_hours = null,
        public ?string $identification_document_path = null,
        public ?string $operating_license_path = null,
        public ?string $social_contract_path = null,
        public ?string $mei_path = null,
        public ?string $status_key = null
    ) {}
}
