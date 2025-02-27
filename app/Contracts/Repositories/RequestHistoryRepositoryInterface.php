<?php

namespace App\Contracts\Repositories;

use App\Core\Filters\RequestHistoryFilter;
use App\Support\Pagination\Pagination;

interface RequestHistoryRepositoryInterface
{
   public function search(int $request_id, RequestHistoryFilter $filter): Pagination;
}
