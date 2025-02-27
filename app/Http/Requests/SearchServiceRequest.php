<?php

namespace App\Http\Requests;

use App\Core\Filters\ServiceFilter;

class SearchServiceRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'establishment_id' => 'sometimes|integer',
            'type_service_key', 'process_number' => ['sometimes', 'string'],
            'uuid' => ['sometimes', 'uuid']
        ];
    }

    public function getData(): ServiceFilter
    {
        $filter = new ServiceFilter();

        $filter->establishmentRef = $this->query('establishment_id');
        $filter->typeServiceKey = $this->query('type_service_key');
        $filter->uuid = $this->query('uuid');
        $filter->processNumber = $this->query('process_number');

        return $filter;
    }
}
