<?php

namespace App\Http\Requests;

use App\Core\VO\Credential;

class AuthenticateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login', 'password' => 'required|string',
        ];
    }

    public function getCredential()
    {
        return Credential::create(
            $this->post('login'),
            $this->post('password')
        );
    }
}
