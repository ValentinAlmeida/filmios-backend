<?php

namespace App\Core\Filters;

use DateTimeInterface;

class UserFilter extends Filter
{
    public ?DateTimeInterface $startDate;
    public ?DateTimeInterface $endDate;
    public ?string $login;
    public ?string $cpf;
    public ?string $name;
    public ?string $profileKey;
    public ?string $email;
    public ?string $telephone;
    public ?bool $block;
    public ?bool $active;
    public ?int $page = 1;
    public ?int $perPage = 100000;
}
