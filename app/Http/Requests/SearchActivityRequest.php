<?php

namespace App\Http\Requests;

use App\Core\Filters\ActivityFilter;

class SearchActivityRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'establishment_id' => ['required', 'integer'],
        ];
    }

    public function getData(): ActivityFilter
    {
        $filter = new ActivityFilter();

        $filter->establishmentRef = $this->input('establishment_id');

        return $filter;
    }
}
