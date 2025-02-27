<?php

namespace App\Models;

class OpeningHoursModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'opening_hours';
    const KEY = 'key';
    const ID = 'id';
    const OPENING_TIME = 'opening_time';
    const CLOSING_TIME = 'closing_time';

    protected $fillable = [
        self::KEY,
        self::OPENING_TIME,
        self::CLOSING_TIME,
    ];
}
