<?php

namespace App\Entities;

use App\Core\DTO\RestoreRequestHistoryDTO;
use App\Core\Entity;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Property\RequestHistoryProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class RequestHistoryEntity extends Entity
{
    private readonly ?int $userApproverRef;
    private RequestHistoryProperty $props;

    public function __construct(
        RequestHistoryProperty $props,
        ?Identifier $identifier = null
    ) {
        $this->props = $props;

        parent::__construct(
            $identifier
        );
    }

    public static function restore(
        RestoreRequestHistoryDTO $restoreRequestDTO,
        int $id
    ): self {
        $props = new RequestHistoryProperty(
            $restoreRequestDTO->statusEnum,
            $restoreRequestDTO->user_approver,
            $restoreRequestDTO->created_At,
            $restoreRequestDTO->observation,
            $restoreRequestDTO->term,
        );

        $request = new self($props, Identifier::create($id));

        $request->setUserApproverRef($restoreRequestDTO->user_approver?->getIdentifier()->getValue());

        return $request;
    }

    public function setUserApproverRef(?int $userApproverRef): void
    {
        $this->userApproverRef = $userApproverRef;
    }

    public function getUserApproverRef(): ?int
    {
        return $this->userApproverRef;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getTerm(): ?DateTimeInterface
    {
        return $this->props->term;
    }

    public function getStatusEnum(): ?StatusEstablishmentEnum
    {
        return $this->props->statusEnum;
    }

    public function getObservation(): ?string
    {
        return $this->props->observation;
    }

    public function setObservation(?string $observation): void
    {
        $this->props->observation = $observation;
    }

    public function getUserApprover(): ?UserEntity
    {
        return $this->props->user_approver;
    }
}
