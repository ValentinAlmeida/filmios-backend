<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\RequestRepositoryInterface;
use App\Core\Filters\RequestFilter;
use App\Entities\Mapper\RequestMapper;
use App\Entities\RequestEntity;
use App\Exceptions\RequestException;
use App\Models\RequestModel;
use App\Support\Pagination\Pagination;
use Illuminate\Database\Eloquent\Builder;

class RequestRepository implements RequestRepositoryInterface
{
    public function create(RequestEntity $data): RequestEntity
    {
        $userModel = RequestModel::create([
            RequestModel::PROFILE_KEY => $data->getProfileEnum()->value,
            RequestModel::STATUS_KEY => $data->getStatusEnum()->value,
            RequestModel::USER_APPROVER_ID => $data->getUserApproverRef(),
            RequestModel::USER_CREATOR_ID => $data->getUserCreatorRef(),
            RequestModel::OBSERVATION => $data->getObservation(),
        ]);

        return RequestMapper::parseModelToEntity($userModel);
    }

    public function search(RequestFilter $filter): Pagination
    {
        $query = $this->applyFilters(RequestModel::query(), $filter);

        $data = $query->count();

        $query = $this->applyPagination($query, $filter);

        return Pagination::create(
            $query->get()->map(fn (RequestModel $model) => RequestMapper::parseModelToEntity($model))->toArray(),
            $data,
            $filter->page,
            $filter->perPage
        );
    }

    private function applyPagination(Builder $query, RequestFilter $filter): Builder
    {
        return $query->skip(($filter->page - 1) * $filter->perPage)->take($filter->perPage);
    }

    private function applyFilters(Builder $query, RequestFilter $filter): Builder
    {
        return $query
            ->when($filter->hasProfileKey(), fn ($q) =>
                $q->whereLike(RequestModel::PROFILE_KEY, like($filter->profileKey))
            )
            ->when($filter->hasStatusKey(), fn ($q) =>
                $q->whereLike(RequestModel::STATUS_KEY, like($filter->statusKey))
            )
            ->when($filter->hasUserApproverId(), fn ($q) =>
                $q->where(RequestModel::USER_APPROVER_ID, $filter->userApproverId)
            )
            ->when($filter->hasUserCreatorId(), fn ($q) =>
                $q->where(RequestModel::USER_CREATOR_ID, $filter->userCreatorId)
            );
    }

    public function update(int $id, RequestEntity $data): void
    {
        $user = RequestModel::find($id);

        throw_if(!$user, RequestException::notFound());

        $user->update([
            RequestModel::PROFILE_KEY => $data->getProfileEnum()->value,
            RequestModel::STATUS_KEY => $data->getStatusEnum()->value,
            RequestModel::USER_APPROVER_ID => app('user')->getIdentifier()->getValue(),
            RequestModel::USER_CREATOR_ID => $data->getUserCreatorRef(),
            RequestModel::OBSERVATION => $data->getObservation(),
            RequestModel::TERM => $data->getTerm(),
        ]);
    }

    public function findById(int $id): RequestEntity
    {
        $model = RequestModel::find($id);

        throw_if(!$model, RequestException::notFound());

        return RequestMapper::parseModelToEntity($model);
    }
}
