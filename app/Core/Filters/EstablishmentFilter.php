<?php

namespace App\Core\Filters;

use DateTimeInterface;

class EstablishmentFilter extends Filter
{
    public ?DateTimeInterface $startDate = null;
    public ?DateTimeInterface $endDate = null;
    public ?bool $isMei = null;
    public ?string $companyName = null;
    public ?string $tradeName = null;
    public ?string $documentKey = null;
    public ?string $statusKey = null;
    public ?string $document = null;
    public ?string $cga = null;
    public ?string $telephone = null;
    public ?string $email = null;
    public ?array $activities = null;
    public ?array $openingHours = null;
    public ?int $unitAddressRef = null;
    public ?int $userRef = null;
    public ?int $page = 1;
    public ?int $perPage = 100000;
}
