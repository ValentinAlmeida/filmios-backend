<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstablishmentModel extends Model
{
    protected $table = self::TABLE;

    const TABLE = 'establishment';
    const IS_MEI = 'is_mei';
    const ID = 'id';
    const COMPANY_NAME = 'company_name';
    const TRADE_NAME = 'trade_name';
    const KEY_DOCUMENT = 'key_document';
    const KEY_STATUS = 'key_status';
    const DOCUMENT = 'document';
    const CGA = 'cga';
    const TELEPHONE = 'telephone';
    const EMAIL = 'email';
    const IDENTIFICATION_DOCUMENT_PATH = 'identification_document_path';
    const OPERATING_LICENSE_PATH = 'operating_license_path';
    const SOCIAL_LICENSE_PATH = 'social_contract_path';
    const MEI_PATH = 'mei_path';
    const ACTIVITY = 'activity';
    const OPENING_HOURS = 'openingHours';
    const UNIT_ADDRESS_ID = 'unit_address_id';
    const LEGAL_GUARDIAN_ID = 'legal_guardian_id';
    const USER_ID = 'user_id';

    protected $fillable = [
        self::IS_MEI,
        self::COMPANY_NAME,
        self::TRADE_NAME,
        self::KEY_DOCUMENT,
        self::DOCUMENT,
        self::CGA,
        self::TELEPHONE,
        self::EMAIL,
        self::IDENTIFICATION_DOCUMENT_PATH,
        self::OPERATING_LICENSE_PATH,
        self::SOCIAL_LICENSE_PATH,
        self::MEI_PATH,
        self::UNIT_ADDRESS_ID,
        self::LEGAL_GUARDIAN_ID,
        self::USER_ID,
        self::KEY_STATUS,
    ];

    public function unitAddress(): BelongsTo
    {
        return $this->belongsTo(UnitAddressModel::class, self::UNIT_ADDRESS_ID);
    }

    public function legalGuardian(): BelongsTo
    {
        return $this->belongsTo(LegalGuardianModel::class, self::LEGAL_GUARDIAN_ID);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, self::USER_ID);
    }

    public function activity()
    {
        return $this->belongsToMany(ActivityModel::class, EstablishmentActivityModel::TABLE, EstablishmentActivityModel::ESTABLISHMENT_ID, EstablishmentActivityModel::ACTIVITY_ID);
    }

    public function openingHours()
    {
        return $this->belongsToMany(OpeningHoursModel::class, EstablishmentOpeningHoursModel::TABLE, EstablishmentOpeningHoursModel::ESTABLISHMENT_ID, EstablishmentOpeningHoursModel::OPENING_HOURS_ID);
    }

    public function request()
    {
        return $this->belongsToMany(RequestModel::class, RequestEstablishmentModel::TABLE, RequestEstablishmentModel::ESTABLISHMENT_ID, RequestEstablishmentModel::REQUEST_ID);
    }
}
