<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\OpeningHoursRepositoryInterface;
use App\Contracts\Services\OpeningHoursServiceInterface;
use App\Core\DTO\CreateOpeningHoursDTO;
use App\Entities\OpeningHoursEntity;

class OpeningHoursService implements OpeningHoursServiceInterface
{
    public function __construct(private readonly OpeningHoursRepositoryInterface $openingHoursRepositoryInterface)
    {
    }

    public function create(CreateOpeningHoursDTO $createOpeningHoursDTO): int
    {
        return $this->openingHoursRepositoryInterface->create(OpeningHoursEntity::create($createOpeningHoursDTO));
    }
}
