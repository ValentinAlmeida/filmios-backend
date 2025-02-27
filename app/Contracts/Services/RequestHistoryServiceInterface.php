<?php

namespace App\Contracts\Services;

use App\Core\Filters\RequestHistoryFilter;
use App\Support\Pagination\Pagination;

interface RequestHistoryServiceInterface
{
    public function search(int $request_id, RequestHistoryFilter $filter): Pagination;
}
