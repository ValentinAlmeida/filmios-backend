<?php

namespace App\Models;

class ActivityModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'activity';
    const START_DATE = 'start_date';
    const ID = 'id';
    const CNAE_ID = 'cnae_id';
    const ESTABLISHMENT = 'establishment';

    protected $fillable = [
        self::START_DATE,
        self::CNAE_ID,
    ];

    public function cnae()
    {
        return $this->belongsTo(CnaeModel::class, self::CNAE_ID);
    }

    public function establishment()
    {
        return $this->belongsToMany(EstablishmentModel::class, EstablishmentActivityModel::TABLE, EstablishmentActivityModel::ACTIVITY_ID, EstablishmentActivityModel::ESTABLISHMENT_ID);
    }
}
