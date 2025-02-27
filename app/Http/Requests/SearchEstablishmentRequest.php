<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\EstablishmentFilter;

class SearchEstablishmentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'user_id' => 'sometimes', 'integer', 'exists:users,id',
            'unit_address_id' => 'sometimes', 'integer', 'exists:unit_address,id',
            'isMei' => ['sometimes', 'string', 'in:true,false'],
            'company_name', 'trade_name', 'document_key', 'document', 'cga', 'telephone', 'email' => ['sometimes', 'string'],
            'start_date', 'end_date' => ['sometimes', 'date_format:' . Format::DATE_TIME],
            'profile_key' => ['sometimes', 'string', ProfileEnum::rule()],
            'status_key' => ['sometimes', 'string', StatusEstablishmentEnum::rule()],
            'page' => 'sometimes|int|min:1',
            'perPage' => 'sometimes|int|min:1|max:100',
        ];
    }

    public function getData(): EstablishmentFilter
    {
        $filter = new EstablishmentFilter();

        $filter->page = value_or_null($this->query('page')) ?? $filter->page;
        $filter->perPage = value_or_null($this->query('perPage')) ?? $filter->perPage;
        $filter->statusKey = value_or_null($this->query('status_key'));
        $filter->startDate = carbon_or_null(Format::DATE_TIME, $this->query('start_date'));
        $filter->endDate = carbon_or_null(Format::DATE_TIME, $this->query('end_date'));
        $filter->userRef = value_or_null($this->query('user_id'));
        $filter->isMei = bool_or_null($this->query('is_mei'));
        $filter->companyName = value_or_null($this->query('company_name'));
        $filter->tradeName = value_or_null($this->query('trade_name'));
        $filter->documentKey = value_or_null($this->query('document_key'));
        $filter->document = value_or_null($this->query('document'));
        $filter->cga = value_or_null($this->query('cga'));
        $filter->telephone = value_or_null($this->query('telephone'));
        $filter->email = value_or_null($this->query('email'));
        $filter->unitAddressRef = value_or_null($this->query('unit_address_id'));

        return $filter;
    }
}
