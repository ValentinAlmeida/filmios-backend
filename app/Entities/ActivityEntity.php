<?php

namespace App\Entities;

use App\Core\DTO\CreateActivityDTO;
use App\Core\DTO\RestoreActivityDTO;
use App\Core\Entity;
use App\Core\Property\ActivityProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class ActivityEntity extends Entity
{
    private int $cnaeRef;
    private function __construct(
        private ActivityProperty $props,
        private ?Identifier $identifier = null,
    ) {
        parent::__construct( $identifier);
    }

    public static function create(
        CreateActivityDTO $createActivityDTO
    ): static {
        $props = new ActivityProperty($createActivityDTO->start_date);

        $activity = new static($props);
        $activity->setCnaeRef($createActivityDTO->cnaeRef);

        return $activity;
    }

    public static function restore(
        RestoreActivityDTO $restoreActivityDTO,
        int $id
    ): static {
        $props = new ActivityProperty(
            $restoreActivityDTO->start_date,
            $restoreActivityDTO->cnaeEntity,
            $restoreActivityDTO->created_at
        );

        $activity = new static($props, Identifier::create($id));
        $activity->setCnaeRef($restoreActivityDTO->cnaeEntity->getIdentifier()->getValue());

        return $activity;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->props->start_date;
    }

    public function getCnaeEntity(): CnaeEntity
    {
        return $this->props->cnaeEntity;
    }

    public function setCnaeRef(int $cnaeRef): void
    {
        $this->cnaeRef = $cnaeRef;
    }

    public function getCnaeRef(): int
    {
        return $this->cnaeRef;
    }

    public function getDescription(): string
    {
        return $this->getCnaeEntity()->getAllName();
    }
}
