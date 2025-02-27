<?php

namespace App\Entities;

use App\Core\DTO\CreateRequestDTO;
use App\Core\DTO\RestoreRequestDTO;
use App\Core\Entity;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Property\RequestProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class RequestEntity extends Entity
{
    private readonly ?int $userApproverRef;
    private readonly ?int $userCreatorRef;
    private RequestProperty $props;

    public function __construct(
        RequestProperty $props,
        ?Identifier $identifier = null
    ) {
        $this->props = $props;

        parent::__construct(
            $identifier
        );
    }

    public static function create(
        CreateRequestDTO $createRequestDTO
    ): self {
        $props = new RequestProperty(
            $createRequestDTO->statusEnum,
            $createRequestDTO->profileEnum,
        );

        $request = new self($props);

        $request->setObservation($createRequestDTO->observation);
        $request->setUserApproverRef($createRequestDTO->user_approver_id);
        $request->setUserCreatorRef($createRequestDTO->user_creator_id);
        $request->setTerm($createRequestDTO->term);

        return $request;
    }

    public static function restore(
        RestoreRequestDTO $restoreRequestDTO,
        int $id
    ): self {
        $props = new RequestProperty(
            $restoreRequestDTO->statusEnum,
            $restoreRequestDTO->profileEnum,
            $restoreRequestDTO->user_approver,
            $restoreRequestDTO->user_creator,
            $restoreRequestDTO->created_At,
            $restoreRequestDTO->observation,
            $restoreRequestDTO->term,
        );

        $request = new self($props, Identifier::create($id));

        $request->setUserApproverRef($restoreRequestDTO->user_approver?->getIdentifier()->getValue());
        $request->setUserCreatorRef($restoreRequestDTO->user_creator->getIdentifier()->getValue());

        return $request;
    }

    public function setUserApproverRef(?int $userApproverRef): void
    {
        $this->userApproverRef = $userApproverRef;
    }

    public function setUserCreatorRef(?int $userCreatorRef): void
    {
        $this->userCreatorRef = $userCreatorRef;
    }

    public function getUserApproverRef(): ?int
    {
        return $this->userApproverRef;
    }

    public function getUserCreatorRef(): int
    {
        return $this->userCreatorRef;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getTerm(): ?DateTimeInterface
    {
        return $this->props->term;
    }

    public function setTerm(?DateTimeInterface $term): void
    {
        $this->props->term = $term;
    }

    public function getProfileEnum(): ?ProfileEnum
    {
        return $this->props->profileEnum;
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

    public function getUserCreator(): ?UserEntity
    {
        return $this->props->user_creator;
    }
}
