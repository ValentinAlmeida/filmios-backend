<?php

namespace App\Infra\Helpers;

use App\Constants\Format;
use App\Core\Contracts\Token;
use Illuminate\Http\Response;

class TokenHelper
{
    public static function withToken(Token $token, Token $refreshToken)
    {
        return response([
            'token' => $token->toString(),
            'refresh_token' => $refreshToken->toString(),
            'expires_on' => $token->getExpiration()->format(Format::DATE_TIME),
        ]);
    }
    public static function refreshToken(Token $token, Token $refreshToken): Response
    {
        return response([
            'token' => $token->toString(),
            'refresh_token' => $refreshToken->toString(),
            'expires_on' => $token->getExpiration()->format(Format::DATE_TIME),
        ]);
    }
    public static function withRefreshToken($entity, Token $refreshToken)
    {
        return [
            'user' => $entity,
            'refresh_token' => $refreshToken->toString(),
        ];
    }
}
