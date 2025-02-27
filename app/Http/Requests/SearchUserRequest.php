<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\Filters\UserFilter;

class SearchUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'login', 'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'active' => ['sometimes', 'string', 'in:true,false'],
            'start_date', 'end_date' => ['sometimes', 'date_format:' . Format::DATE_TIME],
            'page' => 'sometimes|int|min:1',
            'perPage' => 'sometimes|int|min:1|max:100',
        ];
    }

    public function getData(): UserFilter
    {
        $filter = new UserFilter();

        $filter->page = value_or_null($this->query('page')) ?? $filter->page;
        $filter->perPage = value_or_null($this->query('perPage')) ?? $filter->perPage;
        $filter->startDate = carbon_or_null(Format::DATE_TIME, $this->query('start_date'));
        $filter->endDate = carbon_or_null(Format::DATE_TIME, $this->query('end_date'));
        $filter->login = value_or_null($this->query('login'));
        $filter->email = value_or_null($this->query('email'));
        $filter->active = bool_or_null($this->query('active'));
        $filter->name = value_or_null($this->query('name'));

        return $filter;
    }
}
