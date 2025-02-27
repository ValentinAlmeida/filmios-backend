<?php

namespace App\Http\Requests;

use App\Core\DTO\UpdateUserDTO;
use App\Core\Enumerations\ProfileEnum;
use Illuminate\Validation\Rule;
use App\Rules\CpfValidationRule;

class UpdateUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'login', 'name', 'telephone' => ['sometimes', 'string', 'max:255'],
            'cpf' => [
                'sometimes',
                'string',
                new CpfValidationRule,
                Rule::unique('users', 'cpf')->whereNull('deleted_at'),
            ],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'localities' => ['sometimes', 'array'],
            'localities.*' => ['sometimes', 'integer', 'exists:localities,id'],
            'profile_key' => ['sometimes', 'string', ProfileEnum::rule()],
            'active', 'blocked' => ['sometimes', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Já existe um usuário cadastrado para o CPF informado.',
        ];
    }

    public function getData(): UpdateUserDTO
    {
        $dto = new UpdateUserDTO();

        $dto->login = value_or_null($this->input('login'));
        $dto->name = value_or_null($this->input('name'));
        $dto->cpf = value_or_null($this->input('cpf'));
        $dto->email = value_or_null($this->input('email'));
        $dto->profileRef = value_or_null($this->input('profile_key'));
        $dto->localitiesRef = value_or_null($this->input('localities'));
        $dto->active = bool_or_null($this->input('active'));
        $dto->blocked = bool_or_null($this->input('blocked'));
        $dto->telephone = value_or_null($this->input('telephone'));

        return $dto;
    }
}
