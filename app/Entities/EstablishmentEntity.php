<?php

namespace App\Entities;

use App\Core\DTO\CreateEstablishmentDTO;
use App\Core\DTO\RestoreEstablishmentDTO;
use App\Core\Entity;
use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Property\EstablishmentProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class EstablishmentEntity extends Entity
{
    private EstablishmentProperty $props;
    private int $unitAddressRef;
    private int $userRef;
    private int $legalGuardianRef;

    public function __construct(
        EstablishmentProperty $props,
        ?Identifier $identifier = null
    ) {
        $this->props = $props;

        parent::__construct(
            $identifier
        );
    }

    public static function restore(
        RestoreEstablishmentDTO $restoreEstablishmentDTO,
        int $id
    ): self {
        $props = new EstablishmentProperty(
            $restoreEstablishmentDTO->is_mei,
            $restoreEstablishmentDTO->company_name,
            $restoreEstablishmentDTO->trade_name,
            $restoreEstablishmentDTO->documentEnum,
            $restoreEstablishmentDTO->document,
            $restoreEstablishmentDTO->cga,
            $restoreEstablishmentDTO->unitAddressEntity,
            $restoreEstablishmentDTO->userEntity,
            $restoreEstablishmentDTO->telephone,
            $restoreEstablishmentDTO->email,
            $restoreEstablishmentDTO->identification_document_path,
            $restoreEstablishmentDTO->operating_license_path,
            $restoreEstablishmentDTO->social_contract_path,
            $restoreEstablishmentDTO->mei_path,
            $restoreEstablishmentDTO->legalGuardianEntity,
            $restoreEstablishmentDTO->activities,
            $restoreEstablishmentDTO->opening_hours,
            $restoreEstablishmentDTO->created_at,
            $restoreEstablishmentDTO->statusEstablishmentEnum,
        );

        $establishment = new self($props, Identifier::create($id));

        $establishment->setLegalGuardianRef($restoreEstablishmentDTO->legalGuardianEntity?->getIdentifier()->getValue());
        $establishment->setUserRef($restoreEstablishmentDTO->userEntity?->getIdentifier()->getValue());
        $establishment->setUnitAddressRef($restoreEstablishmentDTO->unitAddressEntity?->getIdentifier()->getValue());
        $establishment->setActivitiesRef(array_map(fn (ActivityEntity $activityEntity) => $activityEntity->getIdentifier()->getValue(),$restoreEstablishmentDTO->activities));
        $establishment->setOpeningHoursRef(array_map(fn (OpeningHoursEntity $openingHoursEntity) => $openingHoursEntity->getIdentifier()->getValue(),$restoreEstablishmentDTO->opening_hours));

        return $establishment;
    }

    public static function create(
        CreateEstablishmentDTO $createEstablishmentDTO,
    ): self {
        $props = new EstablishmentProperty(
            $createEstablishmentDTO->is_mei,
            $createEstablishmentDTO->company_name,
            $createEstablishmentDTO->trade_name,
            DocumentEnum::from($createEstablishmentDTO->documentKey),
            $createEstablishmentDTO->document,
            $createEstablishmentDTO->cga,
            null,
            null,
            $createEstablishmentDTO->telephone,
            $createEstablishmentDTO->email,
            $createEstablishmentDTO->identification_document_path,
            $createEstablishmentDTO->operating_license_path,
            $createEstablishmentDTO->social_contract_path,
            $createEstablishmentDTO->mei_path,
            null,
            null,
            null,
            null,
            enum_or_null(StatusEstablishmentEnum::class, $createEstablishmentDTO->status_key)
        );

        $establishment = new self($props);

        $establishment->setLegalGuardianRef($createEstablishmentDTO->legalGuardianRef);
        $establishment->setUserRef($createEstablishmentDTO->userRef);
        $establishment->setUnitAddressRef($createEstablishmentDTO->unitAddressRef);
        $establishment->setActivitiesRef($createEstablishmentDTO->activitiesRef);
        $establishment->setOpeningHoursRef($createEstablishmentDTO->openingHoursRef);

        return $establishment;
    }

    public function setUnitAddressRef(int $unitAddressRef)
    {
        $this->unitAddressRef = $unitAddressRef;
    }

    public function setUserRef(int $userRef)
    {
        $this->userRef = $userRef;
    }

    public function setLegalGuardianRef(int $legalGuardianRef)
    {
        $this->legalGuardianRef = $legalGuardianRef;
    }

    public function getUnitAddressRef(): ?int
    {
        return $this->unitAddressRef;
    }

    public function getUserRef(): int
    {
        return $this->userRef;
    }

    public function getLegalGuardianRef(): int
    {
        return $this->legalGuardianRef;
    }

    public function isMei(): bool
    {
        return $this->props->is_mei;
    }

    public function getCompanyName(): string
    {
        return $this->props->company_name;
    }

    public function getTradeName(): string
    {
        return $this->props->trade_name;
    }

    public function getDocument(): string
    {
        return $this->props->document;
    }

    public function getCga(): string
    {
        return $this->props->cga;
    }

    public function getTelephone(): string
    {
        return $this->props->telephone;
    }

    public function getEmail(): string
    {
        return $this->props->email;
    }

    public function getIdentificationDocumentPath(): ?string
    {
        return $this->props->identification_document_path;
    }

    public function getOperatingLicensePath(): ?string
    {
        return $this->props->operating_license_path;
    }

    public function getSocialContractPath(): ?string
    {
        return $this->props->social_contract_path;
    }

    public function getMeiPath(): ?string
    {
        return $this->props->mei_path;
    }

    public function getActivities(): array
    {
        return $this->props->activities;
    }

    public function getActivitiesRef(): array
    {
        return $this->props->activitiesRef;
    }

    public function getOpeningHours(): array
    {
        return $this->props->opening_hours;
    }

    public function getOpeningHoursRef(): array
    {
        return $this->props->openingHoursRef;
    }

    public function setOpeningHoursRef(array $openingHoursRef): void
    {
        $this->props->openingHoursRef = $openingHoursRef;
    }

    public function setActivitiesRef(array $activitiesRef): void
    {
        $this->props->activitiesRef = $activitiesRef;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getDocumentEnum(): DocumentEnum
    {
        return $this->props->documentEnum;
    }

    public function getStatusEnum(): StatusEstablishmentEnum
    {
        return $this->props->statusEstablishmentEnum;
    }

    public function getUnitAddressEntity(): UnitAddressEntity
    {
        return $this->props->unitAddressEntity;
    }

    public function getUserEntity(): UserEntity
    {
        return $this->props->userEntity;
    }

    public function getLegalGuardianEntity(): LegalGuardianEntity
    {
        return $this->props->legalGuardianEntity;
    }
}
