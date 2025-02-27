<?php

namespace App\Core\Filters;

class ResponsibleFilter extends Filter
{
    public ?int $page = 1;
    public ?int $registrationNumber;
    public ?string $issuingBody;
    public ?string $uf;
    public ?string $numberAdvice;
    public ?int $userRef;
    public ?int $perPage = 100000;
}
