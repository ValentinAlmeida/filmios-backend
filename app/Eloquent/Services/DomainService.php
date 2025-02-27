<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\DomainRepositoryInterface;
use App\Contracts\Services\DomainServiceInterface;
use App\Core\DTO\SearchStatusEstablishmentDTO;
use App\Core\Enumerations\StatusEstablishmentEnum;

class DomainService implements DomainServiceInterface
{
    public function __construct(private readonly DomainRepositoryInterface $domainRepo)
    {
    }

    public function searchLocalities(): array
    {
        return $this->domainRepo->searchLocalities();
    }

    public function searchCnae(): array
    {
        return $this->domainRepo->searchCnae();
    }

    public function searchStatusEstablishment(SearchStatusEstablishmentDTO $searchStatusEstablishmentDTO): array
    {
        $statusEstablishment = StatusEstablishmentEnum::options();

        if (!$searchStatusEstablishmentDTO->isEstablishment) {
            $statusEstablishment = array_filter(
                $statusEstablishment,
                fn($item) => $item['value'] !== StatusEstablishmentEnum::PENDENTE_PAGAMENTO->value
            );
        }

        return $statusEstablishment;
    }
}
