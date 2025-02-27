<?php

namespace App\Support\Pagination;

use App\Core\Property\PaginationProperty;
use Illuminate\Support\Collection;

class Pagination
{
    private PaginationProperty $props;

    private function __construct(
        PaginationProperty $props
    ) {
        $this->props = $props;
    }

    public static function create(
        array|Collection|null $entity,
        ?int $data,
        ?int $page,
        ?int $perPage,
    ): static
    {
        $props = new PaginationProperty();
        $props->entity = $entity;
        $props->data = $data;
        $props->page = $page;
        $props->perPage = $perPage;

        return new static($props);
    }

    public function getEntity(): array|Collection
    {
        return $this->props->entity;
    }

    public function getData(): int
    {
        return $this->props->data;
    }

    public function getPage(): int
    {
        return $this->props->page;
    }

    public function getPerPage(): int
    {
        return $this->props->perPage;
    }

    public function getLastPage(): int
    {
        if ($this->props->perPage === 0 || empty($this->props->entity)) {
            return 1;
        }

        return (int) ceil($this->props->data / $this->props->perPage);
    }

    public function setEntity(array $entidade): void
    {
        $this->props->entity = $entidade;
    }
}
