<?php

namespace App\Models;
class UserLocalityModel extends Model
{
    protected $table = self::TABLE;
    public const USER_ID = 'user_id';
    public const TABLE = 'user_locality';
    public const LOCALITY_ID = 'locality_id';

    protected $fillable = [
        self::USER_ID,
        self::LOCALITY_ID,
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, self::USER_ID);
    }

    public function locality()
    {
        return $this->belongsTo(LocalityModel::class, self::LOCALITY_ID);
    }
}
