<?php

namespace App\Entities;

use App\Core\DTO\CreateOpeningHoursDTO;
use App\Core\DTO\RestoreOpeningHoursDTO;
use App\Core\Entity;
use App\Core\Enumerations\OpeningHoursEnum;
use App\Core\Property\OpeningHoursProperty;
use App\Core\VO\Identifier;
use Carbon\Carbon;

class OpeningHoursEntity extends Entity
{
    private function __construct(
        private OpeningHoursProperty $props,
        private ?Identifier $identifier = null
    ) {
        parent::__construct( $identifier);
    }

    public static function create(
        CreateOpeningHoursDTO $createOpeningHoursDTO
    ): static {
        $props = new OpeningHoursProperty(
            $createOpeningHoursDTO->openingHoursEnum,
            $createOpeningHoursDTO->opening_time,
            $createOpeningHoursDTO->closing_time,
        );
        return new static($props);
    }

    public static function restore(
        RestoreOpeningHoursDTO $restoreOpeningHoursDTO,
        int $id
    ): static {
        $props = new OpeningHoursProperty(
            $restoreOpeningHoursDTO->openingHoursEnum,
            $restoreOpeningHoursDTO->opening_time,
            $restoreOpeningHoursDTO->closing_time,
            $restoreOpeningHoursDTO->created_at,
        );
        return new static($props, Identifier::create($id));
    }

    public function getEnum(): ?OpeningHoursEnum
    {
        return $this->props->openingHoursEnum;
    }

    public function getOpeningTime(): ?string
    {
        return $this->props->opening_time;
    }

    public function getClosingTime(): ?string
    {
        return $this->props->closing_time;
    }
}
