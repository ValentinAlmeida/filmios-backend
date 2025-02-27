<?php

namespace App\Entities;

use App\Core\DTO\CreateServiceDTO;
use App\Core\DTO\RestoreServiceDTO;
use App\Core\Entity;
use App\Core\Enumerations\TypeServicesEnum;
use App\Core\Property\ServiceProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class ServiceEntity extends Entity
{
    private int $establishmentRef;
    private ?int $userRef = null;
    private function __construct(
        private ServiceProperty $props,
        private ?Identifier $uuid = null
    ) {
        parent::__construct($uuid);
    }

    public static function create(
        CreateServiceDTO $createServiceDTO
    ): static {
        $props = new ServiceProperty(
            $createServiceDTO->process_number,
            $createServiceDTO->type_service_key,
        );
        $service = new static($props);
        $service->setEstablishmentRef($createServiceDTO->establishment_id);
        $service->setUserRef($createServiceDTO->user_id);
        $service->setLink($createServiceDTO->link);

        return $service;
    }

    public static function restore(
        RestoreServiceDTO $restoreServiceDTO,
        string $uuid
    ): static {
        $props = new ServiceProperty(
            $restoreServiceDTO->process_number,
            $restoreServiceDTO->type_service_key,
            $restoreServiceDTO->created_at,
            $restoreServiceDTO->establishmentEntity,
            $restoreServiceDTO->link,
            $restoreServiceDTO->qr_path,
            $restoreServiceDTO->userEntity
        );

        $service = new static($props, Identifier::create($uuid));
        $service->setEstablishmentRef($restoreServiceDTO->establishmentEntity->getIdentifier()->getValue());
        $service->setUserRef($restoreServiceDTO->userEntity->getIdentifier()->getValue());

        return $service;
    }

    public function getTypeServiceEnum(): TypeServicesEnum
    {
        return TypeServicesEnum::from($this->getTypeServiceKey());
    }

    public function getProcessNumber(): string
    {
        return $this->props->process_number;
    }

    public function getLink(): string
    {
        return $this->props->link;
    }

    public function getQrPath(): string
    {
        return $this->props->qr_path;
    }

    public function getTypeServiceKey(): string
    {
        return $this->props->type_service_key;
    }

    public function getEstablishment(): EstablishmentEntity
    {
        return $this->props->establishmentEntity;
    }

    public function getUser(): UserEntity
    {
        return $this->props->userEntity;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function setEstablishmentRef(int $establishmentRef): void
    {
        $this->establishmentRef = $establishmentRef;
    }

    public function setUserRef(?int $userRef): void
    {
        $this->userRef = $userRef;
    }

    public function getUserRef(): ?int
    {
        return $this->userRef;
    }

    public function setLink(string $link): void
    {
        $this->props->link = $link;
    }

    public function getEstablishmentRef(): int
    {
        return $this->establishmentRef;
    }
}
