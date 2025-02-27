<?php

namespace App\Http\Requests;

use App\Core\DTO\CreateResponsibleDTO;

class CreateResponsibleRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'registration_number' => ['required', 'integer'],
            'issuing_body', 'uf', 'number_advice' => ['required', 'string'],
        ];
    }

    public function getData(): CreateResponsibleDTO
    {
        return new CreateResponsibleDTO(
            $this->post('registration_number'),
            $this->post('issuing_body'),
            $this->post('uf'),
            $this->post('number_advice'),
            app('user')
        );
    }
}
