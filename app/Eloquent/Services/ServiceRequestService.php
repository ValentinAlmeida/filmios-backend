<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Services\ServiceRequestServiceInterface;
use App\Core\DTO\CreateServiceDTO;
use App\Core\Filters\ServiceFilter;
use App\Entities\ServiceEntity;

class ServiceRequestService implements ServiceRequestServiceInterface
{
    public function __construct(private readonly ServiceRepositoryInterface $serviceRepositoryInterface)
    {
    }

    public function create(CreateServiceDTO $createServiceDTO): string
    {
        return $this->serviceRepositoryInterface->create(ServiceEntity::create($createServiceDTO));
    }

    public function search(ServiceFilter $serviceFilter): array
    {
        return $this->serviceRepositoryInterface->search($serviceFilter);
    }
}
