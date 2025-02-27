<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\RequestRepositoryInterface;
use App\Contracts\Services\RequestServiceInterface;
use App\Core\Contracts\UnitOfWorkInterface;
use App\Core\DTO\CreateRequestDTO;
use App\Core\DTO\UpdateRequestDTO;
use App\Core\Enumerations\ProfileEnum;
use App\Core\Enumerations\StatusEstablishmentEnum;
use App\Core\Filters\RequestFilter;
use App\Entities\RequestEntity;
use App\Entities\UserEntity;
use App\Support\Pagination\Pagination;
use Illuminate\Support\Facades\App;

class RequestService implements RequestServiceInterface
{
    private ?UserEntity $userEntity = null;
    public function __construct(private readonly RequestRepositoryInterface $requestRepo)
    {
    }

    public function create(CreateRequestDTO $data): void
    {
        $unitOfWork = App::make(UnitOfWorkInterface::class);
        $request = RequestEntity::create($data);

        $unitOfWork->run(fn(): RequestEntity => $this->requestRepo->create($request));
    }

    public function update(int $id, UpdateRequestDTO $data): void
    {
        $request = $this->requestRepo->findById($id);

        $createRequest = new CreateRequestDTO(
            $data->profileEnum ?? $request->getProfileEnum(),
            $data->statusEnum ?? $request->getStatusEnum(),
            $data->user_approver_id ?? $request->getUserApproverRef(),
            $data->user_creator_id ?? $request->getUserCreatorRef(),
            $data->observation ?? $request->getObservation(),
            $data->term ?? $request->getTerm(),
        );

        $this->requestRepo->update($id, RequestEntity::create($createRequest));
    }

    public function search(RequestFilter $filter): Pagination
    {
        return $this->requestRepo->search($filter);
    }

    public function findById(int $id): RequestEntity
    {
        return $this->requestRepo->findById($id);
    }

    public function modifyState(int $id, StatusEstablishmentEnum $statusEnum): void
    {
        $updateDTO = new UpdateRequestDTO();

        $updateDTO->statusEnum = $statusEnum;

        $this->update($id, $updateDTO);
    }

    public function searchByUserCreatorId(RequestFilter $requestFilter): Pagination
    {
        $this->userEntity = app('user');
        $user_profile = $this->userEntity->getProfile();
        $validation = $user_profile?->getProfileEnum()->isNotRegulado() ?? false;

        if(!$validation)
        {
            $requestFilter->userCreatorId = (int)$this->userEntity->getIdentifier()->getValue();
            return $this->requestRepo->search($requestFilter);
        }

        $user_profile->getProfileEnum()->isNotFiscal() ? null : $requestFilter->profileKey = ProfileEnum::REGULADO->value;
        return $this->requestRepo->search($requestFilter);
    }
}
