<?php

namespace App\Contracts\Repositories;

use App\Entities\LegalGuardianEntity;

interface LegalGuardianRepositoryInterface
{
   public function create(LegalGuardianEntity $legalGuardianEntity): int;
}
