<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Filters\UserFilter;
use App\Rules\CpfValidationRule;
use Carbon\Carbon;

class SearchUserRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'login', 'name', 'telephone' => ['sometimes', 'string', 'max:255'],
            'cpf' => [
                'sometimes',
                'string'
            ],
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'active' => ['sometimes', 'string', 'in:true,false'],
            'start_date', 'end_date' => ['sometimes', 'date_format:' . Format::DATE_TIME],
            'localities' => 'sometimes|array',
            'profile_key' => ['sometimes', 'string', ProfileEnum::rule()],
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
        $filter->profileKey = value_or_null($this->query('profile_key'));
        $filter->cpf = value_or_null($this->query('cpf'));
        $filter->email = value_or_null($this->query('email'));
        $filter->active = bool_or_null($this->query('active'));
        $filter->name = value_or_null($this->query('name'));
        $filter->telephone = value_or_null($this->query('telephone'));

        return $filter;
    }
}
