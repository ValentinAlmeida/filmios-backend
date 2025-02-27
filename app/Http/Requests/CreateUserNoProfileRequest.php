<?php

namespace App\Http\Requests;

use App\Core\DTO\CreateUserDTO;
use Illuminate\Validation\Rule;
use App\Rules\CpfValidationRule;

class CreateUserNoProfileRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'cpf' => [
                'required',
                'string',
                'size:11',
                new CpfValidationRule,
                Rule::unique('users', 'cpf')->whereNull('deleted_at'),
            ],
            'telephone' => ['required', 'string', Rule::unique('users', 'telephone')->whereNull('deleted_at')],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'url' => ['sometimes', 'string', 'url'],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'A senha deve conter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial.',
            'cpf.unique' => 'Já existe um usuário cadastrado para o CPF informado.',
            'email.unique' => 'Já existe um usuário cadastrado para o EMAIL informado.',
            'telephone.unique' => 'Já existe um usuário cadastrado para o TELEFONE informado.',
        ];
    }

    public function getData(): CreateUserDTO
    {
        return new CreateUserDTO(
            $this->post('cpf'),
            $this->post('cpf'),
            null,
            $this->post('email'),
            null,
            null,
            null,
            null,
            $this->post('url'),
            $this->post('name'),
            $this->post('telephone'),
        );
    }
}
