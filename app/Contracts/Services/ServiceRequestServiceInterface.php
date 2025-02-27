<?php

namespace App\Contracts\Services;

use App\Core\DTO\CreateServiceDTO;
use App\Core\Filters\ServiceFilter;

interface ServiceRequestServiceInterface
{
    public function create(CreateServiceDTO $createServiceDTO): string;

    public function search(ServiceFilter $serviceFilter): array;
}
