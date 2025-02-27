<?php

namespace App\Core\DTO;

class CreateEstablishmentDTO
{
    private ?CreateUnitAddressDTO $createUnitAddressDTO;
    private ?CreateLegalGuardianDTO $createLegalGuardianDTO;
    private ?array $createsActivityDTO;
    private ?array $createsOpeningHoursDTO;

    public function __construct(
        public bool $is_mei,
        public string $company_name,
        public string $trade_name,
        public string $documentKey,
        public string $document,
        public string $cga,
        public ?int $unitAddressRef,
        public int $userRef,
        public string $telephone,
        public string $email,
        public ?int $legalGuardianRef,
        public ?array $activitiesRef = null,
        public ?array $openingHoursRef = null,
        public ?string $identification_document_path = null,
        public ?string $operating_license_path = null,
        public ?string $social_contract_path = null,
        public ?string $mei_path = null,
        public ?string $status_key = null,
    ) {}

    public function setCreateUnitAddressDTO(CreateUnitAddressDTO $createUnitAddressDTO): void
    {
        $this->createUnitAddressDTO = $createUnitAddressDTO;
    }

    public function setCreateLegalGuardianDTO(CreateLegalGuardianDTO $createLegalGuardianDTO): void
    {
        $this->createLegalGuardianDTO = $createLegalGuardianDTO;
    }

    public function setCreatesActivityDTO(array $createsActivityDTO): void
    {
        $this->createsActivityDTO = $createsActivityDTO;
    }

    public function setCreatesOpeningHoursDTO(array $createsOpeningHoursDTO): void
    {
        $this->createsOpeningHoursDTO = $createsOpeningHoursDTO;
    }

    public function getCreateUnitAddressDTO(): CreateUnitAddressDTO
    {
        return $this->createUnitAddressDTO;
    }

    public function getCreateLegalGuardianDTO(): CreateLegalGuardianDTO
    {
        return $this->createLegalGuardianDTO;
    }

    public function getCreatesActivityDTO(): array
    {
        return $this->createsActivityDTO;
    }

    public function getCreatesOpeningHoursDTO(): array
    {
        return $this->createsOpeningHoursDTO;
    }
}
