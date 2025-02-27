<?php

namespace App\Http\Requests;

use App\Core\DTO\RefreshTokenDTO;

class RefreshTokenRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'refresh_token' => ['required', 'string'],
        ];
    }

    public function getRefreshToken(): RefreshTokenDTO
    {
        return new RefreshTokenDTO(
            $this->input('refresh_token'),
        );
    }
}
