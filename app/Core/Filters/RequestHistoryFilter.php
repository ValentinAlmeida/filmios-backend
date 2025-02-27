<?php

namespace App\Core\Filters;

use DateTimeInterface;

class RequestHistoryFilter extends Filter
{
    public ?DateTimeInterface $start_date;
    public ?DateTimeInterface $end_date;
    public ?string $profileKey;
    public ?string $statusKey;
    public ?int $userApproverId;
    public ?int $userCreatorId;
    public ?int $page = 1;
    public ?int $perPage = 100000;
}
