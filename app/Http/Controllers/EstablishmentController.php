<?php

namespace App\Http\Controllers;

use App\Contracts\Services\EstablishmentServiceInterface;
use App\Entities\EstablishmentEntity;
use App\Http\Requests\CreateEstablishmentRequest;
use App\Http\Requests\SearchEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;
use App\Infra\Helpers\PaginationHelper;
use App\Support\Serializers\EstablishmentSerializer;

class EstablishmentController extends Controller
{
    public function __construct(private readonly EstablishmentServiceInterface $establishmentServiceInterface){}

    public function search(SearchEstablishmentRequest $request)
    {
        return PaginationHelper::convertPagingArray($this->establishmentServiceInterface->search($request->getData()), EstablishmentSerializer::class);
    }

    public function findById(int $id)
    {
        return response(EstablishmentSerializer::parseEntity($this->establishmentServiceInterface->findById($id)));
    }

    public function update(int $id, UpdateEstablishmentRequest $request)
    {
        $this->establishmentServiceInterface->update($id, $request->getData());

        return response(null, 204);
    }

    public function create(CreateEstablishmentRequest $request)
    {
        $this->establishmentServiceInterface->create($request->getData());
    }

    public function active(int $id)
    {
        $this->establishmentServiceInterface->active($id);
    }

    public function searchByUserCreatorId()
    {
        return response(array_map(fn (EstablishmentEntity $establishmentEntity) => EstablishmentSerializer::parseEntity($establishmentEntity), $this->establishmentServiceInterface->searchByUserCreatorId()));
    }
}
