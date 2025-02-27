<?php

namespace App\Http\Controllers;

use App\Contracts\Services\RequestHistoryServiceInterface;
use App\Contracts\Services\RequestServiceInterface;
use App\Entities\RequestEntity;
use App\Http\Requests\SearchSolicitationHistoryRequest;
use App\Http\Requests\SearchSolicitationRequest;
use App\Http\Requests\UpdateSolicitationRequest;
use App\Infra\Helpers\PaginationHelper;
use App\Support\Serializers\RequestHistorySerializer;
use App\Support\Serializers\RequestSerializer;
use Illuminate\Support\Facades\App;

class RequestController extends Controller
{
    public function __construct(private readonly RequestServiceInterface $requestServiceInterface){}

    public function search(SearchSolicitationRequest $request)
    {
        return PaginationHelper::convertPagingArray($this->requestServiceInterface->search($request->getData()), RequestSerializer::class);
    }

    public function searchHistory(int $request_id, SearchSolicitationHistoryRequest $request)
    {
        $requestHistory = App::make(RequestHistoryServiceInterface::class);
        return PaginationHelper::convertPagingArray($requestHistory->search($request_id, $request->getData()), RequestHistorySerializer::class);
    }

    public function findById(int $id)
    {
        return response(RequestSerializer::parseEntity($this->requestServiceInterface->findById($id)));
    }

    public function update(int $id, UpdateSolicitationRequest $request)
    {
        $this->requestServiceInterface->update($id, $request->getData());

        return response(null, 204);
    }

    public function searchByUserCreatorId(SearchSolicitationRequest $request)
    {
        return response(array_map(fn (RequestEntity $requestEntity) => RequestSerializer::parseEntity($requestEntity), $this->requestServiceInterface->searchByUserCreatorId($request->getData())->getEntity()));
    }
}
