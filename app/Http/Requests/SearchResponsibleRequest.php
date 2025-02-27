<?php

namespace App\Http\Requests;

use App\Core\Filters\ResponsibleFilter;

class SearchResponsibleRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'page' => 'sometimes|int|min:1',
            'registration_number' => 'sometimes|integer',
            'issuing_body', 'uf', 'number_advice', 'user_id' => ['sometimes', 'string'],
            'perPage' => 'sometimes|int|min:1|max:100',
        ];
    }

    public function getData(): ResponsibleFilter
    {
        $filter = new ResponsibleFilter();

        $this->has('page') ? $filter->page = $this->query('page') : null;
        $this->has('perPage') ? $filter->perPage = $this->query('perPage') : null;
        $this->has('registration_number') ? $filter->registrationNumber = $this->query('registration_number') : null;
        $this->has('issuing_body') ? $filter->issuingBody = $this->query('issuing_body') : null;
        $this->has('uf') ? $filter->uf = $this->query('uf') : null;
        $this->has('number_advice') ? $filter->numberAdvice = $this->query('number_advice') : null;
        $this->has('user_id') ? $filter->userRef = $this->query('user_id') : null;

        return $filter;
    }
}
