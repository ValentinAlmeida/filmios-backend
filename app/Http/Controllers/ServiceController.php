<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ServiceRequestServiceInterface;
use App\Core\Enumerations\TypeServicesEnum;
use App\Core\Filters\ServiceFilter;
use App\Entities\ServiceEntity;
use App\Exceptions\ServiceException;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\SearchServiceRequest;
use App\Support\Serializers\ServiceSerializer;
use Carbon\Carbon;
use Illuminate\Support\Str;
use InvalidArgumentException;

class ServiceController extends Controller
{
    public function __construct(private readonly ServiceRequestServiceInterface $serviceRequestServiceInterface) {}

    public function searchDispensa(int $establishment_id)
    {
        $date = Carbon::now()->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY');

        $filter = new ServiceFilter();
        $filter->establishmentRef = $establishment_id;
        $filter->typeServiceKey = TypeServicesEnum::DISPENSA->value;

        $service = $this->serviceRequestServiceInterface->search($filter);

        throw_if(empty($service), ServiceException::notFound());

        return view('dispensa', ['date' => $this->formatDate($date), 'service' => end($service)]);
    }

    public function create(CreateServiceRequest $createServiceRequest)
    {
        $this->serviceRequestServiceInterface->create($createServiceRequest->getData());
    }

    public function search(SearchServiceRequest $request)
    {
        return array_map(fn (ServiceEntity $serviceEntity) => ServiceSerializer::parseEntity($serviceEntity), $this->serviceRequestServiceInterface->search($request->getData()));
    }

    public function findByUuid(string $uuid)
    {
        throw_if(!Str::isUuid($uuid), ServiceException::invalid('uuid'));

        $filter = new ServiceFilter();
        $filter->uuid = $uuid;

        $entity = $this->serviceRequestServiceInterface->search($filter);

        return ServiceSerializer::parseBasicEntity(end($entity));
    }

    private function formatDate(string $date): string {
        $words = explode(' ', $date);
        $words[2] = ucfirst($words[2] ?? '');
        return implode(' ', $words);
    }
}
