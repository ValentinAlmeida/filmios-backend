<?php

namespace App\Models;
class EstablishmentActivityModel extends Model
{
    protected $table = self::TABLE;
    public const ESTABLISHMENT_ID = 'establishment_id';
    public const TABLE = 'establishment_activity';
    public const ACTIVITY_ID = 'activity_id';

    protected $fillable = [
        self::ESTABLISHMENT_ID,
        self::ACTIVITY_ID,
    ];
}
