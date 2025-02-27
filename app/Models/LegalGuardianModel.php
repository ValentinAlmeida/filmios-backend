<?php

namespace App\Models;

class LegalGuardianModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'legal_guardian';
    const NAME = 'name';
    const CPF = 'cpf';

    protected $fillable = [
        self::NAME,
        self::CPF,
    ];
}
