<?php

namespace App\Models;
class EstablishmentOpeningHoursModel extends Model
{
    protected $table = self::TABLE;
    public const ESTABLISHMENT_ID = 'establishment_id';
    public const TABLE = 'establishment_opening_hours';
    public const OPENING_HOURS_ID = 'opening_hours_id';

    protected $fillable = [
        self::ESTABLISHMENT_ID,
        self::OPENING_HOURS_ID,
    ];
}
