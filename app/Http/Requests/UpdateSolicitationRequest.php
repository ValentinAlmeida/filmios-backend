<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\DTO\UpdateRequestDTO;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;

class UpdateSolicitationRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'profile_key' => ['sometimes', 'string', ProfileEnum::rule()],
            'status_key' => ['sometimes', 'string', StatusEstablishmentEnum::rule()],
            'observation' => ['sometimes', 'string'],
            'term' => ['sometimes', 'date_format:' . Format::DATE_TIME],
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Já existe um usuário cadastrado para o CPF informado.',
        ];
    }

    public function getData(): UpdateRequestDTO
    {
        $dto = new UpdateRequestDTO();

        $dto->profileEnum = enum_or_null(ProfileEnum::class, $this->input('profile_key'));
        $dto->statusEnum = enum_or_null(StatusEstablishmentEnum::class, $this->input('status_key'));
        $dto->observation = value_or_null($this->input('observation'));
        $dto->term = carbon_or_null(Format::DATE_TIME, $this->input('term'));

        return $dto;
    }
}
