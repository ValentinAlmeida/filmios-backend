<?php

namespace App\Contracts\Services;

use App\Core\DTO\SearchStatusEstablishmentDTO;

interface DomainServiceInterface
{
    public function searchLocalities(): array;
    public function searchCnae(): array;
    public function searchStatusEstablishment(SearchStatusEstablishmentDTO $searchStatusEstablishmentDTO): array;
}
