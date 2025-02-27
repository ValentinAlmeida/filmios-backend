<?php

namespace App\Models;

class CnaeModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'cnae';
    const DESCRIPTION = 'description';
    const CODE = 'code';

    protected $fillable = [
        self::DESCRIPTION,
        self::CODE,
    ];
}
