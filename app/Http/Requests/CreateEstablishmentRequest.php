<?php

namespace App\Http\Requests;

use App\Constants\Format;
use App\Core\DTO\CreateActivityDTO;
use App\Core\DTO\CreateEstablishmentDTO;
use App\Core\DTO\CreateLegalGuardianDTO;
use App\Core\DTO\CreateOpeningHoursDTO;
use App\Core\DTO\CreateUnitAddressDTO;
use App\Core\Enumerations\OpeningHoursEnum;

class CreateEstablishmentRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'company_name', 'trade_name', 'document_key',
            'document', 'cga', 'telephone', 'email' => ['required', 'string'],
            'address.number', 'activities.*.cnae_id' => ['required', 'integer'],
            'address.withNumber', 'is_mei' => ['sometimes', 'boolean'],
            'address.complement', 'address.neighborhood', 'address.municipality',
            'address.referencePoint', 'legal_guardian.name', 'legal_guardian.cpf',
            'address.typeOfStreet', 'address.cep', 'address.street' => ['required', 'string'],
            'activities', 'opening_hours', 'address', 'legal_guardian' => ['required', 'array'],
            'activities.*.start_date' => ['required', 'date_format:' . Format::DATE_TIME],
            'opening_hours.*.opening_time', 'opening_hours.*.closing_time' => ['required', 'date_format:' . Format::SCHEDULE],
            'opening_hours.*.opening_hours_key' => ['required', 'string', OpeningHoursEnum::rule()]
        ];
    }

    public function getData(): CreateEstablishmentDTO
    {
        $createEstablishmentDTO = new CreateEstablishmentDTO(
            (bool)$this->post('is_mei'),
            $this->post('company_name'),
            $this->post('trade_name'),
            $this->post('document_key'),
            $this->post('document'),
            $this->post('cga'),
            null,
            app('user')->getIdentifier()->getValue(),
            $this->post('telephone'),
            $this->post('email'),
            null,
            null,
            null,
        );

        $createEstablishmentDTO->setCreateUnitAddressDTO($this->getCreateUnitAddressDTO());
        $createEstablishmentDTO->setCreateLegalGuardianDTO($this->getCreateLegalGuardianDTO());
        $createEstablishmentDTO->setCreatesActivityDTO($this->getCreateActivityDTO());
        $createEstablishmentDTO->setCreatesOpeningHoursDTO($this->getCreateOpeningHoursDTO());

        return $createEstablishmentDTO;
    }

    private function getCreateUnitAddressDTO(): CreateUnitAddressDTO
    {
        $address = $this->post('address', []);

        return new CreateUnitAddressDTO(
            data_get($address, 'cep'),
            data_get($address, 'typeOfStreet'),
            data_get($address, 'street'),
            data_get($address, 'number'),
            data_get($address, 'withNumber'),
            data_get($address, 'complement'),
            data_get($address, 'neighborhood'),
            data_get($address, 'municipality'),
            data_get($address, 'referencePoint')
        );
    }

    private function getCreateLegalGuardianDTO(): CreateLegalGuardianDTO
    {
        $legal_guardian = $this->post('legal_guardian', []);

        return new CreateLegalGuardianDTO(
            data_get($legal_guardian, 'name'),
            data_get($legal_guardian, 'cpf'),
        );
    }

    private function getCreateActivityDTO(): array
    {
        return array_map(fn ($activity) => new CreateActivityDTO(
            carbon_or_null(Format::DATE_TIME, $activity['start_date']),
            $activity['cnae_id']
        ), $this->post('activities'));
    }

    private function getCreateOpeningHoursDTO(): array
    {
        return array_map(fn ($opening_hours) => new CreateOpeningHoursDTO(
            OpeningHoursEnum::from($opening_hours['opening_hours_key']),
            carbon_or_null(Format::SCHEDULE, $opening_hours['opening_time']),
            carbon_or_null(Format::SCHEDULE,$opening_hours['closing_time'])
        ), $this->post('opening_hours'));
    }
}
