<?php

namespace App\Http\Requests;

use App\Core\Filters\FeatureFilter;

class SearchFeatureRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'profile_key' => ['sometimes', 'string'],
        ];
    }

    public function getData(): FeatureFilter
    {
        $filter = new FeatureFilter();

        $filter->profileKey = $this->query('profile_key');

        return $filter;
    }
}
