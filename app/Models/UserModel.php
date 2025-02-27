<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model implements Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    const LOGIN = 'login';
    const CPF = 'cpf';
    const EMAIL = 'email';
    const TELEPHONE = 'telephone';
    const PASSWORD = 'password';
    const PROFILE_KEY = 'profile_key';
    const ACTIVE = 'active';
    const BLOCK = 'block';
    const NAME = 'name';

    protected $fillable = [
        self::CPF,
        self::NAME,
        self::EMAIL,
        self::LOGIN,
        self::PASSWORD,
        self::TELEPHONE,
        self::PROFILE_KEY,
        self::ACTIVE,
        self::BLOCK,
    ];

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthIdentifierName()
    {
        return self::$primaryKey;
    }

    public function getAuthPassword()
    {
        return $this->getAttribute(self::PASSWORD);
    }

    public function getAuthPasswordName()
    {
        return '';
    }

    public function getJWTIdentifier()
    {
        return $this->getAuthIdentifier();
    }

    public function getRememberToken()
    {
        return '';
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function setRememberToken($value)
    {
        //
    }

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class, self::PROFILE_KEY, ProfileModel::KEY);
    }

    public function localities()
    {
        return $this->belongsToMany(LocalityModel::class, UserLocalityModel::TABLE, UserLocalityModel::USER_ID, UserLocalityModel::LOCALITY_ID);
    }
}
