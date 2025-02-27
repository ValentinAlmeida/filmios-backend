<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\ResponsibleRepositoryInterface;
use App\Contracts\Services\ResponsibleServiceInterface;
use App\Core\DTO\CreateResponsibleDTO;
use App\Core\DTO\UpdateResponsibleDTO;
use App\Core\Filters\ResponsibleFilter;
use App\Entities\ResponsibleEntity;
use App\Infra\FileStorageServiceMixin;
use App\Infra\FileSystem\Contracts\Path;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;
use App\Infra\Helpers\RandomHelper;
use App\Infra\LocalCDNPath;
use App\Support\Pagination\Pagination;

class ResponsibleService implements ResponsibleServiceInterface
{
    use FileStorageServiceMixin;

    public function __construct(private readonly ResponsibleRepositoryInterface $responsibleRepositoryInterface)
    {
        $this->initializeStorage('responsible');
    }

    public function create(CreateResponsibleDTO $data): void
    {
        $responsible = ResponsibleEntity::create($data);

        $this->responsibleRepositoryInterface->create($responsible);
    }


    public function update(int $id, UpdateResponsibleDTO $data): void
    {
        $entity = $this->findById($id);

        $createDTO = new CreateResponsibleDTO(
            $data->registration_number ?? $entity->getRegistrationNumber(),
            $data->issuing_body ?? $entity->getIssuingBody(),
            $data->uf ?? $entity->getUf(),
            $data->number_advice ?? $entity->getNumberAdvice(),
            $entity->getUser(),
            $data->file_path ?? $entity->getFilePath(),
            $entity->getActive(),
        );

        $responsible = ResponsibleEntity::create($createDTO);

        $this->responsibleRepositoryInterface->update($id, $responsible);
    }

    public function findById(int $id): ResponsibleEntity
    {
        return $this->responsibleRepositoryInterface->findById($id);
    }

    public function active(int $id): void
    {
        $this->responsibleRepositoryInterface->active($id);
    }

    public function search(ResponsibleFilter $filter): Pagination
    {
        return $this->responsibleRepositoryInterface->search($filter);
    }

    public function modifyPath(int $id, Path $path): void
    {
        $this->updatePath($id, $path);
    }

    public function deletePath(int $id): void
    {
        $this->updatePath($id, '');
    }

    public function buildArchive(?UTF8Content $contentArchive, int $id): void
    {
        $archive = $this->saveArchive(RandomHelper::getRand(), $contentArchive);

        $this->modifyPath($id, LocalCDNPath::build($archive->getPath()->relative()));
    }

    private function updatePath(int $id, string|Path $path): void
    {
        $dto = new UpdateResponsibleDTO();
        $dto->file_path = $path;

        $this->update($id, $dto);
    }
}
