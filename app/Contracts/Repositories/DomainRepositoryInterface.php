<?php

namespace App\Contracts\Repositories;

interface DomainRepositoryInterface
{
   public function searchLocalities(): array;
   public function searchCnae(): array;
}
