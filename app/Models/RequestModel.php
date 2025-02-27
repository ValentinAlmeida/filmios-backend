<?php

namespace App\Models;
class RequestModel extends Model
{
    protected $table = 'request';
    public const PROFILE_KEY = 'profile_key';
    public const STATUS_KEY = 'status_establishment_key';
    public const USER_APPROVER_ID = 'user_approver_id';
    public const USER_CREATOR_ID = 'user_creator_id';
    public const OBSERVATION = 'observation';
    public const TERM = 'term';

    protected $fillable = [
        self::USER_APPROVER_ID,
        self::USER_CREATOR_ID,
        self::STATUS_KEY,
        self::PROFILE_KEY,
        self::OBSERVATION,
        self::TERM,
    ];

    public function userApprover()
    {
        return $this->belongsTo(UserModel::class, self::USER_APPROVER_ID);
    }

    public function userCreator()
    {
        return $this->belongsTo(UserModel::class, self::USER_CREATOR_ID);
    }

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class, self::PROFILE_KEY, ProfileModel::KEY);
    }

    public function requestResponsible()
    {
        return $this->hasMany(RequestResponsiblesModel::class, RequestResponsiblesModel::REQUEST_ID);
    }
}
