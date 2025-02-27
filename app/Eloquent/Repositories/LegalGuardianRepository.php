<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\LegalGuardianRepositoryInterface;
use App\Entities\LegalGuardianEntity;
use App\Models\LegalGuardianModel;

class LegalGuardianRepository implements LegalGuardianRepositoryInterface
{
    public function create(LegalGuardianEntity $legalGuardianEntity): int
    {
        $model = LegalGuardianModel::create([
            LegalGuardianModel::NAME => $legalGuardianEntity->getName(),
            LegalGuardianModel::CPF => $legalGuardianEntity->getCpf(),
        ]);

        return $model->id;
    }
}
