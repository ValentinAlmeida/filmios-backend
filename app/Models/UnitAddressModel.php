<?php

namespace App\Models;
class UnitAddressModel extends Model
{
    protected $table = 'unit_address';
    public const CEP = 'cep';
    public const TYPE_OF_STREET = 'type_of_street';
    public const STREET = 'street';
    public const NUMBER = 'number';
    public const WITH_NUMBER = 'with_number';
    public const COMPLEMENT = 'complement';
    public const NEIGHBORHOOD = 'neighborhood';
    public const MUNICIPALITY = 'municipality';
    public const REFERENCE_POINT = 'reference_point';

    protected $fillable = [
        self::CEP,
        self::TYPE_OF_STREET,
        self::STREET,
        self::NUMBER,
        self::WITH_NUMBER,
        self::COMPLEMENT,
        self::NEIGHBORHOOD,
        self::MUNICIPALITY,
        self::REFERENCE_POINT,
    ];

    public function establishment()
    {
        return $this->hasMany(EstablishmentModel::class, EstablishmentModel::UNIT_ADDRESS_ID);
    }
}
