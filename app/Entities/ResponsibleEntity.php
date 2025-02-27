<?php

namespace App\Entities;

use App\Core\DTO\CreateResponsibleDTO;
use App\Core\DTO\RestoreResponsibleDTO;
use App\Core\Entity;
use App\Core\Property\ResponsibleProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class ResponsibleEntity extends Entity
{
    private ResponsibleProperty $props;

    private function __construct(
        ResponsibleProperty $props,
        private ?Identifier $identifier = null,
    ) {
        parent::__construct( $identifier);

        $this->props = $props;
    }

    public static function create(
        CreateResponsibleDTO $createResponsibleDTO
    ): static {
        $props = new ResponsibleProperty(
            $createResponsibleDTO->registration_number,
            $createResponsibleDTO->issuing_body,
            $createResponsibleDTO->uf,
            $createResponsibleDTO->number_advice,
            $createResponsibleDTO->activity,
            null,
            $createResponsibleDTO->file_path,
            $createResponsibleDTO->userEntity
        );

        return new static($props);
    }

    public static function restore(
        int $id,
        RestoreResponsibleDTO $restoreResponsibleDTO
    ): static {
        $props = new ResponsibleProperty(
            $restoreResponsibleDTO->registration_number,
            $restoreResponsibleDTO->issuing_body,
            $restoreResponsibleDTO->uf,
            $restoreResponsibleDTO->number_advice,
            $restoreResponsibleDTO->active,
            $restoreResponsibleDTO->created_at,
            $restoreResponsibleDTO->file_path,
            $restoreResponsibleDTO->userEntity
        );

        return new static($props, Identifier::create($id));
    }

    public function getRegistrationNumber(): int
    {
        return $this->props->registration_number;
    }

    public function getFilePath(): ?string
    {
        return $this->props->file_path;
    }

    public function getIssuingBody(): string
    {
        return $this->props->issuing_body;
    }

    public function getUf(): string
    {
        return $this->props->uf;
    }

    public function getNumberAdvice(): string
    {
        return $this->props->number_advice;
    }

    public function getUser(): UserEntity
    {
        return $this->props->userEntity;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getActive(): ?bool
    {
        return $this->props->active;
    }
}
