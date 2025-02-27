<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\EstablishmentRepositoryInterface;
use App\Contracts\Services\ActivityServiceInterface;
use App\Contracts\Services\EstablishmentServiceInterface;
use App\Contracts\Services\LegalGuardianServiceInterface;
use App\Contracts\Services\OpeningHoursServiceInterface;
use App\Contracts\Services\UnitAddressServiceInterface;
use App\Core\Contracts\UnitOfWorkInterface;
use App\Core\DTO\CreateActivityDTO;
use App\Core\DTO\CreateEstablishmentDTO;
use App\Core\DTO\CreateLegalGuardianDTO;
use App\Core\DTO\CreateOpeningHoursDTO;
use App\Core\DTO\CreateUnitAddressDTO;
use App\Core\DTO\UpdateArchiveEstablishmentDTO;
use App\Core\DTO\UpdateEstablishmentDTO;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\EstablishmentFilter;
use App\Entities\EstablishmentEntity;
use App\Infra\FileStorageServiceMixin;
use App\Infra\FileSystem\Contracts\Archive;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;
use App\Support\Pagination\Pagination;
use Illuminate\Support\Facades\App;

class EstablishmentService implements EstablishmentServiceInterface
{
    use FileStorageServiceMixin;

    public function __construct(private readonly EstablishmentRepositoryInterface $establishmentRepositoryInterface)
    {
        $this->initializeStorage('responsible');
    }

    public function create(CreateEstablishmentDTO $data): void
    {
        $establishment = EstablishmentEntity::create($this->createAllClasses($data));

        $this->establishmentRepositoryInterface->create($establishment);
    }

    public function createAllClasses(CreateEstablishmentDTO $createEstablishmentDTO): CreateEstablishmentDTO
    {
        $unitOfWork = App::make(UnitOfWorkInterface::class);

        $unitOfWork->run(function() use ($createEstablishmentDTO){
            $createEstablishmentDTO->unitAddressRef = $this->createUnitAddress($createEstablishmentDTO->getCreateUnitAddressDTO());
            $createEstablishmentDTO->legalGuardianRef = $this->createLegalGuardian($createEstablishmentDTO->getCreateLegalGuardianDTO());
            $createEstablishmentDTO->activitiesRef = array_map(fn (CreateActivityDTO $createActivityDTO) => $this->createActivity($createActivityDTO), $createEstablishmentDTO->getCreatesActivityDTO());
            $createEstablishmentDTO->openingHoursRef = array_map(fn (CreateOpeningHoursDTO $createOpeningHoursDTO) => $this->createOpeningHours($createOpeningHoursDTO), $createEstablishmentDTO->getCreatesOpeningHoursDTO());
        });

        return $createEstablishmentDTO;
    }

    private function createUnitAddress(CreateUnitAddressDTO $createUnitAddressDTO): int
    {
        $unitAddressService = App::make(UnitAddressServiceInterface::class);

        return $unitAddressService->create($createUnitAddressDTO);
    }

    private function createLegalGuardian(CreateLegalGuardianDTO $createLegalGuardianDTO): int
    {
        $legalGuardianService = App::make(LegalGuardianServiceInterface::class);

        return $legalGuardianService->create($createLegalGuardianDTO);
    }

    private function createActivity(CreateActivityDTO $createActivityDTO): int
    {
        $activityService = App::make(ActivityServiceInterface::class);

        return $activityService->create($createActivityDTO);
    }

    private function createOpeningHours(CreateOpeningHoursDTO $createOpeningHoursDTO): int
    {
        $openingHoursService = App::make(OpeningHoursServiceInterface::class);

        return $openingHoursService->create($createOpeningHoursDTO);
    }

    public function update(int $id, UpdateEstablishmentDTO $data): void
    {
        $establishment = $this->establishmentRepositoryInterface->findById($id);

        $createEstablishment = new CreateEstablishmentDTO(
            $data->is_mei ?? $establishment->isMei(),
            $data->company_name ?? $establishment->getCompanyName(),
            $data->trade_name ?? $establishment->getTradeName(),
            $data->documentKey ?? $establishment->getDocumentEnum()->value,
            $data->document ?? $establishment->getDocument(),
            $data->cga ?? $establishment->getCga(),
            $data->unitAddressRef ?? $establishment->getUnitAddressRef(),
            $data->userRef ?? $establishment->getUserRef(),
            $data->telephone ?? $establishment->getTelephone(),
            $data->email ?? $establishment->getEmail(),
            $data->legalGuardianRef ?? $establishment->getLegalGuardianRef(),
            $data->activities ?? $establishment->getActivitiesRef(),
            $data->opening_hours ?? $establishment->getOpeningHoursRef(),
            $data->identification_document_path ?? $establishment->getIdentificationDocumentPath(),
            $data->operating_license_path ?? $establishment->getOperatingLicensePath(),
            $data->social_contract_path ?? $establishment->getSocialContractPath(),
            $data->mei_path ?? $establishment->getMeiPath(),
            $establishment->getStatusEnum()->value,
        );

        $this->establishmentRepositoryInterface->update($id, EstablishmentEntity::create($createEstablishment));
    }

    public function search(EstablishmentFilter $filter): Pagination
    {
        return $this->establishmentRepositoryInterface->search($filter);
    }

    public function findById(int $id): EstablishmentEntity
    {
        return $this->establishmentRepositoryInterface->findById($id);
    }

    public function modifyState(int $id, StatusEstablishmentEnum $statusEnum): void
    {
        $updateDTO = new UpdateEstablishmentDTO();

        $updateDTO->status_key = $statusEnum->value;

        $this->update($id, $updateDTO);
    }

    public function searchByUserCreatorId(): array
    {
        return $this->establishmentRepositoryInterface->searchByUserCreatorId((int)app('user')->getIdentifier()->getValue());
    }

    public function active(int $id): void
    {
        $this->establishmentRepositoryInterface->active($id);
    }

    public function updatePath(int $id, UpdateArchiveEstablishmentDTO $updateDTO): void
    {
        $dto = new UpdateEstablishmentDTO();
        $dto->identification_document_path = $updateDTO->getIdentificationDocumentPath();
        $dto->operating_license_path = $updateDTO->getOperatingLicensePath();
        $dto->social_contract_path = $updateDTO->getSocialContractPath();
        $dto->mei_path = $updateDTO->getMeiPath();

        $this->update($id, $dto);
    }

    public function saveArchivePattern(int $random, ?UTF8Content $content): ?Archive
    {
        $content ? $archive = $this->saveArchive($random, $content) : $archive = null;

        return $archive;
    }
}
