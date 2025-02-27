<?php

namespace App\Http\Requests;

use App\Core\DTO\UpdateResponsibleDTO;

class UpdateResponsibleRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'registration_number' => ['sometimes', 'integer'],
            'file_path' => ['sometimes', 'string'],
            'issuing_body', 'uf', 'number_advice' => ['sometimes', 'string'],
        ];
    }

    public function getData(): UpdateResponsibleDTO
    {
        return new UpdateResponsibleDTO(
            $this->post('registration_number'),
            $this->post('issuing_body'),
            $this->post('uf'),
            $this->post('number_advice'),
            $this->post('file_path'),
        );
    }
}
