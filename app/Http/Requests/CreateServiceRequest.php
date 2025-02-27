<?php

namespace App\Http\Requests;

use App\Core\DTO\CreateServiceDTO;
use App\Core\Enumerations\TypeServicesEnum;
use App\Infra\Helpers\RandomHelper;

class CreateServiceRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'establishment_id' => ['required', 'integer', 'exists:establishment,id'],
            'url' => ['required', 'string'],
            'type_service_key' => ['required', 'string', TypeServicesEnum::rule()],
        ];
    }

    public function getData(): CreateServiceDTO
    {
        return new CreateServiceDTO(
            $this->post('establishment_id'),
            RandomHelper::getProtocol(),
            $this->post('type_service_key'),
            $this->post('url'),
        );
    }
}
