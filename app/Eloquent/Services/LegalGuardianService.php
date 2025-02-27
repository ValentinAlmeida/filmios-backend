<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\LegalGuardianRepositoryInterface;
use App\Contracts\Services\LegalGuardianServiceInterface;
use App\Core\DTO\CreateLegalGuardianDTO;
use App\Entities\LegalGuardianEntity;

class LegalGuardianService implements LegalGuardianServiceInterface
{
    public function __construct(private readonly LegalGuardianRepositoryInterface $legalGuardianRepositoryInterface)
    {
    }

    public function create(CreateLegalGuardianDTO $createLegalGuardianDTO): int
    {
        return $this->legalGuardianRepositoryInterface->create(LegalGuardianEntity::create($createLegalGuardianDTO));

    }
}
