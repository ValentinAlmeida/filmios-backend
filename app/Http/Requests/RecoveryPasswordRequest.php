<?php

namespace App\Http\Requests;

use App\Core\DTO\RecoveryPasswordDTO;

class RecoveryPasswordRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'url' => 'required',
        ];
    }

    public function getRecoveryPasswordDTO(): RecoveryPasswordDTO
    {
        return new RecoveryPasswordDTO(
            $this->input('email'),
            $this->input('url'),
        );
    }
}
