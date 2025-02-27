<?php

namespace App\Models;

class Domain extends Model
{
    const DESCRIPTION = 'description';
    protected $fillable = [
        self::DESCRIPTION,
    ];
}
