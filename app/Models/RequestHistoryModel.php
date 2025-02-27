<?php

namespace App\Models;
class RequestHistoryModel extends Model
{
    protected $table = 'request_history';
    public const STATUS_KEY = 'status_establishment_key';
    public const USER_APPROVER_ID = 'user_approver_id';
    public const OBSERVATION = 'observation';
    public const TERM = 'term';
    public const REQUEST_ID = 'request_id';

    protected $fillable = [
        self::USER_APPROVER_ID,
        self::STATUS_KEY,
        self::OBSERVATION,
        self::REQUEST_ID,
        self::TERM,
    ];

    public function userApprover()
    {
        return $this->belongsTo(UserModel::class, self::USER_APPROVER_ID);
    }

    public function request()
    {
        return $this->belongsTo(RequestModel::class, self::REQUEST_ID);
    }
}
