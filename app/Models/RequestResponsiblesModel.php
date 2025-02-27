<?php

namespace App\Models;
class RequestResponsiblesModel extends Model
{
    protected $table = self::TABLE;
    public const REQUEST_ID = 'request_id';
    public const TABLE = 'request_responsibles';
    public const RESPONSIBLE_ID = 'responsibles_id';

    protected $fillable = [
        self::REQUEST_ID,
        self::RESPONSIBLE_ID,
    ];

    public function request()
    {
        return $this->belongsTo(RequestModel::class, self::REQUEST_ID);
    }

    public function responsible()
    {
        return $this->belongsTo(ResponsibleModel::class, self::RESPONSIBLE_ID);
    }
}
