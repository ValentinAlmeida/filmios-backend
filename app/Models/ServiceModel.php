<?php

namespace App\Models;

use Illuminate\Support\Str;
class ServiceModel extends Model
{
    protected $table = 'service';
    public $incrementing = false;
    public $primaryKey = self::UUID;
    public const UUID = 'uuid';
    public const ESTABLISHMENT_ID = 'establishment_id';
    public const USER_ID = 'user_id';
    public const PROCESS_NUMBER = 'process_number';
    public const TYPE_SERVICE_KEY = 'type_service_key';
    public const QR_PATH = 'qr_path';
    public const LINK = 'link';

    protected $fillable = [
        self::UUID,
        self::ESTABLISHMENT_ID,
        self::PROCESS_NUMBER,
        self::TYPE_SERVICE_KEY,
        self::QR_PATH,
        self::LINK,
        self::USER_ID,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{self::UUID})) {
                $model->{self::UUID} = Str::uuid()->toString();
            }
        });
    }

    public function establishment()
    {
        return $this->belongsTo(EstablishmentModel::class, self::ESTABLISHMENT_ID);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, self::USER_ID);
    }
}
