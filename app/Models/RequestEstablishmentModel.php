<?php

namespace App\Models;
class RequestEstablishmentModel extends Model
{
    protected $table = self::TABLE;
    public const REQUEST_ID = 'request_id';
    public const TABLE = 'request_establishment';
    public const ESTABLISHMENT_ID = 'establishment_id';

    protected $fillable = [
        self::REQUEST_ID,
        self::ESTABLISHMENT_ID,
    ];

    public function request()
    {
        return $this->belongsTo(RequestModel::class, self::REQUEST_ID);
    }

    public function establishment()
    {
        return $this->belongsTo(EstablishmentModel::class, self::ESTABLISHMENT_ID);
    }
}
