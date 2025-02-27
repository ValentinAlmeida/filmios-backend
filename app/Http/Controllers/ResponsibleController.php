<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ResponsibleServiceInterface;
use App\Http\Requests\CreateResponsibleRequest;
use App\Http\Requests\SearchResponsibleRequest;
use App\Http\Requests\UpdateResponsibleRequest;
use App\Infra\Helpers\PaginationHelper;
use App\Support\Serializers\ResponsibleSerializer;

class ResponsibleController extends Controller
{
    public function __construct(private readonly ResponsibleServiceInterface $responsibleServiceInterface){}

    public function search(SearchResponsibleRequest $request)
    {
        return PaginationHelper::convertPagingArray($this->responsibleServiceInterface->search($request->getData()), ResponsibleSerializer::class);
    }

    public function active(int $id)
    {
        $this->responsibleServiceInterface->active($id);
    }

    public function findById(int $id)
    {
        return ResponsibleSerializer::parseEntity($this->responsibleServiceInterface->findById($id));
    }

    public function create(CreateResponsibleRequest $request)
    {
        $this->responsibleServiceInterface->create($request->getData());
    }

    public function update(int $id, UpdateResponsibleRequest $request)
    {
        $this->responsibleServiceInterface->update($id, $request->getData());
    }
}
