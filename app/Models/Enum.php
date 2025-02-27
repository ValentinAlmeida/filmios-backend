<?php

namespace App\Models;

class Enum extends Model
{
    const KEY = 'key';
    protected $fillable = [
        self::KEY,
    ];
}
