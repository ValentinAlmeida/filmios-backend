<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\EstablishmentRepositoryInterface;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\EstablishmentFilter;
use App\Entities\EstablishmentEntity;
use App\Entities\Mapper\EstablishmentMapper;
use App\Exceptions\EstablishmentException;
use App\Models\ActivityModel;
use App\Models\EstablishmentModel;
use App\Models\OpeningHoursModel;
use App\Models\RequestModel;
use App\Models\UserModel;
use App\Support\Pagination\Pagination;

class EstablishmentRepository implements EstablishmentRepositoryInterface
{
    public function create(EstablishmentEntity $data): EstablishmentEntity
    {
        $responsible = EstablishmentModel::where(EstablishmentModel::DOCUMENT, (int)$data->getDocument())->get();

        throw_if($responsible->isNotEmpty(), EstablishmentException::alreadyExists());

        $establishmentModel = EstablishmentModel::create([
            EstablishmentModel::KEY_DOCUMENT => $data->getDocumentEnum()->value,
            EstablishmentModel::IS_MEI => $data->isMei(),
            EstablishmentModel::COMPANY_NAME => $data->getCompanyName(),
            EstablishmentModel::TRADE_NAME => $data->getTradeName(),
            EstablishmentModel::DOCUMENT => $data->getDocument(),
            EstablishmentModel::CGA => $data->getCga(),
            EstablishmentModel::UNIT_ADDRESS_ID => $data->getUnitAddressRef(),
            EstablishmentModel::USER_ID => $data->getUserRef(),
            EstablishmentModel::TELEPHONE => $data->getTelephone(),
            EstablishmentModel::EMAIL => $data->getEmail(),
            EstablishmentModel::LEGAL_GUARDIAN_ID => $data->getLegalGuardianRef(),
            EstablishmentModel::KEY_STATUS => StatusEstablishmentEnum::PENDENTE_ANALISE->value,
        ]);

        $establishmentModel->activity()->sync($data->getActivitiesRef());
        $establishmentModel->openingHours()->sync($data->getOpeningHoursRef());

        return EstablishmentMapper::parseModelToEntity($establishmentModel);
    }

    public function search(EstablishmentFilter $filter): Pagination
    {
        $query = EstablishmentModel::query();

        $query = $query
        ->when($filter->hasCompanyName(), fn ($q) =>
            $q->whereLike(EstablishmentModel::COMPANY_NAME, like($filter->companyName))
        )
        ->when($filter->hasIsMei(), fn ($q) =>
            $q->where(EstablishmentModel::IS_MEI, $filter->isMei)
        )
        ->when($filter->hasTradeName(), fn ($q) =>
            $q->where(EstablishmentModel::TRADE_NAME, $filter->tradeName)
        )
        ->when($filter->hasDocumentKey(), fn ($q) =>
            $q->where(EstablishmentModel::KEY_DOCUMENT, $filter->documentKey)
        )
        ->when($filter->hasStatusKey(), fn ($q) =>
            $q->where(EstablishmentModel::KEY_STATUS, $filter->statusKey)
        )
        ->when($filter->hasDocument(), fn ($q) =>
            $q->where(EstablishmentModel::DOCUMENT, $filter->document)
        )
        ->when($filter->hasCga(), fn ($q) =>
            $q->where(EstablishmentModel::CGA, $filter->cga)
        )
        ->when($filter->hasTelephone(), fn ($q) =>
            $q->where(EstablishmentModel::TELEPHONE, $filter->telephone)
        )
        ->when($filter->hasEmail(), fn ($q) =>
            $q->where(EstablishmentModel::EMAIL, $filter->email)
        )
        ->when($filter->hasUnitAddressRef(), fn ($q) =>
            $q->where(EstablishmentModel::UNIT_ADDRESS_ID, $filter->unitAddressRef)
        )
        ->when($filter->hasUserRef(), fn ($q) =>
            $q->where(EstablishmentModel::USER_ID, $filter->userRef)
        )
        ->when($filter->hasActivities(), fn ($q) =>
            $q->whereRelation(EstablishmentModel::ACTIVITY, ActivityModel::ID, 'in', $filter->activities)
        )
        ->when($filter->hasOpeningHours(), fn ($q) =>
            $q->whereRelation(EstablishmentModel::OPENING_HOURS, OpeningHoursModel::ID, 'in', $filter->openingHours)
        )
        ->when($filter->hasStartDate(), fn ($q) =>
            $q->whereDate(EstablishmentModel::CREATED_AT, '>=', $filter->startDate)
        )
        ->when($filter->hasEndDate(), fn ($q) =>
            $q->whereDate(EstablishmentModel::CREATED_AT, '<=', $filter->endDate)
        );

        $page = $filter->page;
        $perPage = $filter->perPage;

        $data = $query->count();

        $query->skip(($page - 1) * $perPage)->take($perPage);

        return Pagination::create(
            $query->get()->map(fn (EstablishmentModel $model) => EstablishmentMapper::parseModelToEntity($model))->toArray(),
            $data,
            $page,
            $perPage
        );
    }

    public function update(int $id, EstablishmentEntity $data): void
    {
        $establishmentModel = EstablishmentModel::find($id);

        throw_if(!$establishmentModel, EstablishmentException::notFound());

        $establishmentModel->update([
            EstablishmentModel::KEY_DOCUMENT => $data->getDocumentEnum()->value,
            EstablishmentModel::IS_MEI => $data->isMei(),
            EstablishmentModel::COMPANY_NAME => $data->getCompanyName(),
            EstablishmentModel::TRADE_NAME => $data->getTradeName(),
            EstablishmentModel::DOCUMENT => $data->getDocument(),
            EstablishmentModel::CGA => $data->getCga(),
            EstablishmentModel::UNIT_ADDRESS_ID => $data->getUnitAddressRef(),
            EstablishmentModel::USER_ID => $data->getUserRef(),
            EstablishmentModel::TELEPHONE => $data->getTelephone(),
            EstablishmentModel::EMAIL => $data->getEmail(),
            EstablishmentModel::LEGAL_GUARDIAN_ID => $data->getLegalGuardianRef(),
            EstablishmentModel::MEI_PATH => $data->getMeiPath(),
            EstablishmentModel::SOCIAL_LICENSE_PATH => $data->getSocialContractPath(),
            EstablishmentModel::OPERATING_LICENSE_PATH => $data->getOperatingLicensePath(),
            EstablishmentModel::IDENTIFICATION_DOCUMENT_PATH => $data->getIdentificationDocumentPath(),
            EstablishmentModel::KEY_STATUS => $data->getStatusEnum()->value,
        ]);

        $establishmentModel->activity()->sync($data->getActivitiesRef());
        $establishmentModel->openingHours()->sync($data->getOpeningHoursRef());
    }

    public function findById(int $id): EstablishmentEntity
    {
        $model = EstablishmentModel::find($id);

        throw_if(!$model, EstablishmentException::notFound());

        return EstablishmentMapper::parseModelToEntity($model);
    }

    public function searchByUserCreatorId(int $userId): array
    {
        $model = EstablishmentModel::where(EstablishmentModel::USER_ID, $userId)->get();

        return $model->map(fn (EstablishmentModel $establishmentModel) => EstablishmentMapper::parseModelToEntity($establishmentModel))->toArray();
    }

    public function active(int $id): void
    {
        $model = EstablishmentModel::find($id);

        throw_if(empty($model), EstablishmentException::notFound());

        $user = $model->user()->first();
        empty($user->profile_key) ? $user->update([UserModel::PROFILE_KEY => ProfileEnum::REGULADO, UserModel::ACTIVE => true]) : null;

        $model->request()->latest()->first()->update([
            RequestModel::STATUS_KEY => StatusEstablishmentEnum::APROVADO->value,
            RequestModel::USER_APPROVER_ID => (int)app('user')->getIdentifier()->getValue()
        ]);
    }
}
