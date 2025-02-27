<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateLegalGuardianDTO;

interface LegalGuardianServiceInterface
{
    public function create(CreateLegalGuardianDTO $createLegalGuardianDTO): int;
}
