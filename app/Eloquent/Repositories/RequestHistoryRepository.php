<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\RequestHistoryRepositoryInterface;
use App\Core\Filters\RequestHistoryFilter;
use App\Entities\Mapper\RequestHistoryMapper;
use App\Models\RequestHistoryModel;
use App\Support\Pagination\Pagination;

class RequestHistoryRepository implements RequestHistoryRepositoryInterface
{
    public function search(int $request_id, RequestHistoryFilter $filter): Pagination
    {
        $query = RequestHistoryModel::query();

        $query->where(RequestHistoryModel::REQUEST_ID, $request_id);

        $query = $query
        ->when($filter->hasStatusKey(), fn ($q) =>
            $q->whereLike(RequestHistoryModel::STATUS_KEY, like($filter->statusKey))
        )
        ->when($filter->hasUserApproverId(), fn ($q) =>
            $q->where(RequestHistoryModel::USER_APPROVER_ID, $filter->userApproverId)
        );

        $page = $filter->page;
        $perPage = $filter->perPage;

        $data = $query->count();

        $query->skip(($page - 1) * $perPage)->take($perPage);

        return Pagination::create(
            $query->get()->map(fn (RequestHistoryModel $model) => RequestHistoryMapper::parseModelToEntity($model))->toArray(),
            $data,
            $page,
            $perPage
        );
    }
}
