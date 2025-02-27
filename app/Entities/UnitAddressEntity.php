<?php

namespace App\Entities;

use App\Core\DTO\CreateUnitAddressDTO;
use App\Core\DTO\RestoreUnitAddressDTO;
use App\Core\Entity;
use App\Core\Property\UnitAddressProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class UnitAddressEntity extends Entity
{
    private UnitAddressProperty $props;

    public function __construct(
        UnitAddressProperty $props,
        ?Identifier $identifier = null
    ) {
        $this->props = $props;

        parent::__construct(
            $identifier
        );
    }

    public static function restore(
        RestoreUnitAddressDTO $restoreUnitAddressDTO,
        int $id
    ): self {
        $props = new UnitAddressProperty(
            $restoreUnitAddressDTO->cep,
            $restoreUnitAddressDTO->typeOfStreet,
            $restoreUnitAddressDTO->street,
            $restoreUnitAddressDTO->number,
            $restoreUnitAddressDTO->withNumber,
            $restoreUnitAddressDTO->complement,
            $restoreUnitAddressDTO->neighborhood,
            $restoreUnitAddressDTO->number,
            $restoreUnitAddressDTO->number,
            $restoreUnitAddressDTO->created_at,
        );

        return new self($props, Identifier::create($id));
    }

    public static function create(
        CreateUnitAddressDTO $createUnitAddressDTO
    ): self {
        $props = new UnitAddressProperty(
            $createUnitAddressDTO->cep,
            $createUnitAddressDTO->typeOfStreet,
            $createUnitAddressDTO->street,
            $createUnitAddressDTO->number,
            $createUnitAddressDTO->withNumber,
            $createUnitAddressDTO->complement,
            $createUnitAddressDTO->neighborhood,
            $createUnitAddressDTO->number,
            $createUnitAddressDTO->number,
        );

        return new self($props);
    }

    public function getCep(): string
    {
        return $this->props->cep;
    }

    public function getTypeOfStreet(): string
    {
        return $this->props->typeOfStreet;
    }

    public function getStreet(): string
    {
        return $this->props->street;
    }

    public function getNumber(): int
    {
        return $this->props->number;
    }

    public function getWithNumber(): bool
    {
        return $this->props->withNumber;
    }

    public function getComplement(): string
    {
        return $this->props->complement;
    }

    public function getNeighborhood(): string
    {
        return $this->props->neighborhood;
    }

    public function getMunicipality(): string
    {
        return $this->props->municipality;
    }

    public function getReferencePoint(): string
    {
        return $this->props->referencePoint;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->props->created_at;
    }
}
