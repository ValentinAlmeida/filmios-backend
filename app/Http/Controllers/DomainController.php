<?php

namespace App\Http\Controllers;

use App\Contracts\Services\DomainServiceInterface;
use App\Contracts\Services\EstablishmentServiceInterface;
use App\Core\Enumerations\DocumentEnum;
use App\Core\Enumerations\OpeningHoursEnum;
use App\Core\Enumerations\TypeServicesEnum;
use App\Core\Filters\EstablishmentFilter;
use App\Entities\EstablishmentEntity;
use App\Entities\UserEntity;
use App\Http\Requests\SearchStatusEstablishmentRequest;
use App\Support\Serializers\CnaeSerializer;
use App\Support\Serializers\DomainSerializer;
use App\Support\Serializers\EnumSerializer;
use App\Support\Serializers\EstablishmentSerializer;
use Illuminate\Support\Facades\App;

class DomainController extends Controller
{
    private ?UserEntity $userEntity = null;

    public function __construct(private readonly DomainServiceInterface $domainService){}

    public function searchLocalities()
    {
        return response(array_map(fn ($domain) => DomainSerializer::parseEntity($domain), $this->domainService->searchLocalities()));
    }

    public function searchStatusEstablishment(SearchStatusEstablishmentRequest $request)
    {
        return response(array_map(fn ($enum) => EnumSerializer::parseEnum($enum), $this->domainService->searchStatusEstablishment($request->getData())));
    }

    public function searchCnae()
    {
        return response(array_map(fn ($domain) => CnaeSerializer::parseEntity($domain), $this->domainService->searchCnae()));
    }

    public function searchOpeningHours()
    {
        return response(array_map(fn ($domain) => EnumSerializer::parseEnum($domain), OpeningHoursEnum::options()));
    }

    public function searchDocument()
    {
        return response(array_map(fn ($domain) => EnumSerializer::parseEnum($domain), DocumentEnum::options()));
    }

    public function searchTypeServices()
    {
        return response(array_map(fn ($domain) => EnumSerializer::parseEnum($domain), TypeServicesEnum::options()));
    }

    public function searchEstablishment()
    {
        $this->userEntity = app('user');
        $establishmentService = App::make(EstablishmentServiceInterface::class);

        $filter = new EstablishmentFilter();
        $this->userEntity->getProfile()->getProfileEnum()->isNotRegulado() ? null : $filter->userRef = (int)$this->userEntity->getIdentifier()->getValue();

        return response(array_map(fn (EstablishmentEntity $establishment) => EstablishmentSerializer::parseEntityToDomain($establishment), $establishmentService->search($filter)->getEntity()));
    }
}
