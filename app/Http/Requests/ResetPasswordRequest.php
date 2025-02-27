<?php

namespace App\Http\Requests;

use App\Core\DTO\ResetPasswordDTO;

class ResetPasswordRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'password' => [
                'sometimes',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'password_confirmation' => [
                'sometimes',
                'string',
                'min:8'
            ],
        ];
    }

    public function getResetPasswordDTO(): ResetPasswordDTO
    {
        return new ResetPasswordDTO(
            $this->input('password'),
        );
    }
}
