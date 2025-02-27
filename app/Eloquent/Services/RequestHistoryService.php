<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\RequestHistoryRepositoryInterface;
use App\Contracts\Services\RequestHistoryServiceInterface;
use App\Core\Filters\RequestHistoryFilter;
use App\Support\Pagination\Pagination;

class RequestHistoryService implements RequestHistoryServiceInterface
{
    public function __construct(private readonly RequestHistoryRepositoryInterface $requestRepo)
    {
    }

    public function search(int $request_id, RequestHistoryFilter $filter): Pagination
    {
        return $this->requestRepo->search($request_id, $filter);
    }
}
