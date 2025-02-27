<?php

namespace App\Models;
class ResponsibleModel extends Model
{
    protected $table = 'responsibles';
    const FILE_PATH = 'file_path';
    const REGISTRATION_NUMBER = 'registration_number';
    const ISSUING_BODY = 'issuing_body';
    const UF = 'uf';
    const NUMBER_ADVICE = 'number_advice';
    const ACTIVE = 'active';
    const USER_ID = 'user_id';

    protected $fillable = [
        self::FILE_PATH,
        self::REGISTRATION_NUMBER,
        self::ISSUING_BODY,
        self::UF,
        self::NUMBER_ADVICE,
        self::ACTIVE,
        self::USER_ID,
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, self::USER_ID);
    }

    public function request()
    {
        return $this->belongsToMany(RequestModel::class, RequestResponsiblesModel::TABLE, RequestResponsiblesModel::RESPONSIBLE_ID, RequestResponsiblesModel::REQUEST_ID);
    }
}
