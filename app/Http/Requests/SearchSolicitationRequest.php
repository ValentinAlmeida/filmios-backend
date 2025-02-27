<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\RequestFilter;
use Carbon\Carbon;

class SearchSolicitationRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'user_approver_id', 'user_creator_id' => 'sometimes', 'integer', 'exists:users,id',
            "start_date", "end_date" => ['sometimes', 'date_format:' . Format::DATE_TIME],
            'profile_key' => ['sometimes', 'string', ProfileEnum::rule()],
            'status_key' => ['sometimes', 'string', StatusEstablishmentEnum::rule()],
            'page' => 'sometimes|int|min:1',
            'perPage' => 'sometimes|int|min:1|max:100',
        ];
    }

    public function getData(): RequestFilter
    {
        $filter = new RequestFilter();

        $filter->page = value_or_null($this->query('page')) ?? $filter->page;
        $filter->perPage = value_or_null($this->query('perPage')) ?? $filter->perPage;
        $filter->profileKey = value_or_null($this->query('profile_key'));
        $filter->statusKey = value_or_null($this->query('status_key'));
        $filter->userApproverId = value_or_null($this->query('user_approver_id'));
        $filter->userCreatorId = value_or_null($this->query('user_creator_id'));
        $filter->start_date = carbon_or_null(Format::DATE_TIME, $this->query('start_date'));
        $filter->end_date = carbon_or_null(Format::DATE_TIME, $this->query('end_date'));

        return $filter;
    }
}
