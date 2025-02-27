<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\ResponsibleRepositoryInterface;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\ResponsibleFilter;
use App\Entities\Mapper\ResponsibleMapper;
use App\Entities\ResponsibleEntity;
use App\Exceptions\ResponsibleException;
use App\Models\RequestModel;
use App\Models\ResponsibleModel;
use App\Models\UserModel;
use App\Support\Pagination\Pagination;

class ResponsibleRepository implements ResponsibleRepositoryInterface
{
    public function search(ResponsibleFilter $filter): Pagination
    {
        $query = ResponsibleModel::query();

        $query = $query
        ->when($filter->hasRegistrationNumber(), fn ($q) =>
            $q->where(ResponsibleModel::REGISTRATION_NUMBER, $filter->registrationNumber)
        )
        ->when($filter->hasIssuingBody(), fn ($q) =>
            $q->where(ResponsibleModel::ISSUING_BODY, $filter->issuingBody)
        )
        ->when($filter->hasUf(), fn ($q) =>
            $q->where(ResponsibleModel::UF, $filter->uf)
        )
        ->when($filter->hasNumberAdvice(), fn ($q) =>
            $q->where(ResponsibleModel::NUMBER_ADVICE, $filter->numberAdvice)
        )
        ->when($filter->hasUserRef(), fn ($q) =>
            $q->where(ResponsibleModel::USER_ID, $filter->userRef)
        );

        $page = $filter->page;
        $perPage = $filter->perPage;

        $data = $query->count();

        $query->skip(($page - 1) * $perPage)->take($perPage);

        return Pagination::create(
            $query->get()->map(fn (ResponsibleModel $model) => ResponsibleMapper::parseModelToEntity($model))->toArray(),
            $data,
            $page,
            $perPage
        );
    }

    public function create(ResponsibleEntity $entity): void
    {
        $responsible = ResponsibleModel::where(ResponsibleModel::USER_ID, (int)$entity->getUser()->getIdentifier()->getValue())->get();

        throw_if($responsible->isNotEmpty(), ResponsibleException::alreadyExists());

        ResponsibleModel::create([
            ResponsibleModel::REGISTRATION_NUMBER => $entity->getRegistrationNumber(),
            ResponsibleModel::FILE_PATH => $entity->getFilePath(),
            ResponsibleModel::ISSUING_BODY => $entity->getIssuingBody(),
            ResponsibleModel::UF => $entity->getUf(),
            ResponsibleModel::NUMBER_ADVICE => $entity->getNumberAdvice(),
            ResponsibleModel::ACTIVE => 1,
            ResponsibleModel::USER_ID => $entity->getUser()->getIdentifier()->getValue()
        ]);
    }

    public function update(int $id, ResponsibleEntity $entity): void
    {
        $model = ResponsibleModel::find($id);

        $model->update([
            ResponsibleModel::REGISTRATION_NUMBER => $entity->getRegistrationNumber(),
            ResponsibleModel::FILE_PATH => $entity->getFilePath(),
            ResponsibleModel::ISSUING_BODY => $entity->getIssuingBody(),
            ResponsibleModel::UF => $entity->getUf(),
            ResponsibleModel::NUMBER_ADVICE => $entity->getNumberAdvice(),
            ResponsibleModel::ACTIVE => $entity->getActive(),
            ResponsibleModel::USER_ID => $entity->getUser()->getIdentifier()->getValue()
        ]);
    }

    public function findById(int $id): ResponsibleEntity
    {
        $model = ResponsibleModel::find($id);

        throw_if(empty($model), ResponsibleException::notFound());

        return ResponsibleMapper::parseModelToEntity($model);
    }

    public function active(int $id): void
    {
        $model = ResponsibleModel::find($id);

        throw_if(empty($model), ResponsibleException::notFound());

        $model->update([
            ResponsibleModel::ACTIVE => true
        ]);

        $user = $model->user()->first();
        empty($user->profile_key) ? $user->update([UserModel::PROFILE_KEY => ProfileEnum::FISCAL, UserModel::ACTIVE => true]) : null;

        $model->request()->latest()->first()->update([
            RequestModel::STATUS_KEY => StatusEstablishmentEnum::APROVADO->value,
            RequestModel::USER_APPROVER_ID => (int)app('user')->getIdentifier()->getValue()
        ]);
    }
}
