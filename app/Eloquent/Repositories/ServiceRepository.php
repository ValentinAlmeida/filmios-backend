<?php

namespace App\Eloquent\Repositories;

use App\Contracts\Repositories\ServiceRepositoryInterface;
use App\Contracts\Services\QrCodeServiceInterface;
use App\Core\Filters\ServiceFilter;
use App\Entities\Mapper\ServiceMapper;
use App\Entities\ServiceEntity;
use App\Models\ServiceModel;
use Illuminate\Support\Facades\App;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function create(ServiceEntity $serviceEntity): string
    {
        $model = ServiceModel::firstOrCreate(
            [
                ServiceModel::ESTABLISHMENT_ID => $serviceEntity->getEstablishmentRef(),
                ServiceModel::TYPE_SERVICE_KEY => $serviceEntity->getTypeServiceKey(),
            ],
            [
                ServiceModel::PROCESS_NUMBER => $serviceEntity->getProcessNumber(),
                ServiceModel::LINK => $serviceEntity->getLink(),
                ServiceModel::USER_ID => app('user')->getIdentifier()->getValue(),
            ]
        );

        $new_link = "$model->link?uuid=$model->uuid";

        $qrService = App::make(QrCodeServiceInterface::class);
        $qrPath = $qrService->generateQrCode($new_link);

        $model->update([ServiceModel::QR_PATH => $qrPath]);

        return $model->uuid;
    }

    public function search(ServiceFilter $filter): array
    {
        $query = ServiceModel::query();

        $query = $query
        ->when($filter->hasEstablishmentRef(), fn ($q) =>
            $q->where(ServiceModel::ESTABLISHMENT_ID, $filter->establishmentRef)
        )
        ->when($filter->hasTypeServiceKey(), fn ($q) =>
            $q->where(ServiceModel::TYPE_SERVICE_KEY, $filter->typeServiceKey)
        )
        ->when($filter->hasUuid(), fn ($q) =>
            $q->where(ServiceModel::UUID, $filter->uuid)
        )
        ->when($filter->hasProcessNumber(), fn ($q) =>
            $q->where(ServiceModel::PROCESS_NUMBER, $filter->processNumber)
        );

        return $query->get()->map(fn (ServiceModel $serviceModel) => ServiceMapper::parse($serviceModel))->toArray();
    }
}
