<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Model implements Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    const LOGIN = 'login';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const ACTIVE = 'active';
    const BLOCK = 'block';
    const NAME = 'name';

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::LOGIN,
        self::PASSWORD,
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
}
