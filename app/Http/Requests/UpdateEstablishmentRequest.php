<?php

namespace App\Http\Requests;

use App\Core\DTO\UpdateEstablishmentDTO;
use App\Core\DTO\UpdateRequestDTO;
use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;

class UpdateEstablishmentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'document_key' => ['sometimes', 'string', DocumentEnum::rule()],
            'status_key' => ['sometimes', 'string', StatusEstablishmentEnum::rule()],
            'is_mei' => ['sometimes', 'boolean'],
            'unit_address_id', 'user_id' , 'legal_guardian_id', 'activies_id.*' => ['sometimes', 'integer'],
            'company_name', 'trade_name', 'document', 'cga',
            'telephone', 'email' => ['sometimes', 'string'],
            'activies', 'opening_hours' => ['array', 'sometimes']
        ];
    }

    public function messages()
    {
        return [
            'cpf.unique' => 'Já existe um usuário cadastrado para o CPF informado.',
        ];
    }

    public function getData(): UpdateEstablishmentDTO
    {
        $dto = new UpdateEstablishmentDTO();

        $dto->documentKey = enum_or_null(DocumentEnum::class, $this->input('document_key'));
        $dto->status_key = enum_or_null(StatusEstablishmentEnum::class, $this->input('status_key'));
        $dto->is_mei = $this->input('is_mei');
        $dto->company_name = value_or_null($this->input('company_name'));
        $dto->trade_name = value_or_null($this->input('trade_name'));
        $dto->document = value_or_null($this->input('document'));
        $dto->cga = value_or_null($this->input('cga'));
        $dto->unitAddressRef = value_or_null($this->input('unit_address_id'));
        $dto->userRef = value_or_null($this->input('user_id'));
        $dto->telephone = value_or_null($this->input('telephone'));
        $dto->email = value_or_null($this->input('email'));
        $dto->legalGuardianRef = value_or_null($this->input('legal_guardian_id'));
        $dto->activities = value_or_null($this->input('activies'));
        $dto->opening_hours = value_or_null($this->input('opening_hours'));

        return $dto;
    }
}
