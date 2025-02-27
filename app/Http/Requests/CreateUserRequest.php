<?php

namespace App\Http\Requests;

use App\Core\DTO\CreateUserDTO;
use App\Core\Enumerations\ProfileEnum;
use Illuminate\Validation\Rule;
use App\Rules\CpfValidationRule;

class CreateUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'url' => ['sometimes', 'string', 'url'],
            'name', 'login' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'A senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial.',
            'email.unique' => 'Já existe um usuário cadastrado para o EMAIL informado.',
        ];
    }

    public function getData(): CreateUserDTO
    {
        return new CreateUserDTO(
            $this->post('login'),
            null,
            $this->post('email'),
            null,
            null,
            $this->post('url'),
            $this->post('name'),
        );
    }
}
