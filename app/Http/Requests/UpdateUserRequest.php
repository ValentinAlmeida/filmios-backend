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
            'login', 'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
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
        $dto->email = value_or_null($this->input('email'));
        $dto->active = bool_or_null($this->input('active'));
        $dto->blocked = bool_or_null($this->input('blocked'));

        return $dto;
    }
}
