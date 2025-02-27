<?php

namespace App\Http\Requests;

use App\Core\DTO\SearchStatusEstablishmentDTO;

class SearchStatusEstablishmentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'isEstablishment' => ['sometimes', 'string', 'in:true,false'],
        ];
    }

    public function getData(): SearchStatusEstablishmentDTO
    {
        return new SearchStatusEstablishmentDTO(
            bool_or_null($this->query('isEstablishment')),
        );
    }
}
