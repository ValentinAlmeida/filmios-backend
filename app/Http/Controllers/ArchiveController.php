<?php

namespace App\Http\Controllers;

use App\Contracts\Services\EstablishmentServiceInterface;
use App\Contracts\Services\ResponsibleServiceInterface;
use App\Http\Requests\CreateArchiveRequest;
use App\Http\Requests\CreateEstablishmentArchiveRequest;
use App\Infra\FileSystem\Exceptions\ArchiveException;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;
use App\Infra\Helpers\RandomHelper;
use App\Infra\Services\DeliveryFileService;
use App\Util\ArchiveUtil;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArchiveController extends Controller
{
    public function __construct(private readonly DeliveryFileService $service){}

    public function createResponsible(int $id, CreateArchiveRequest $request)
    {
        $entityInterface = App::make(ResponsibleServiceInterface::class);
        $archiveContent = $request->getArchiveContent();

        $this->buildArchive($archiveContent, $id, $entityInterface);

        return response('', 204);
    }

    public function createEstablishment(int $id, CreateEstablishmentArchiveRequest $request)
    {
        $entityInterface = App::make(EstablishmentServiceInterface::class);

        $updateArchive = $request->getArchiveContent();

        $updateArchive->setIdentificationDocumentPath($entityInterface->saveArchivePattern(RandomHelper::getRand(), $updateArchive->getIdentificationDocumentContent())?->getPath()->relative());
        $updateArchive->setMeiPath($entityInterface->saveArchivePattern(RandomHelper::getRand(), $updateArchive->getMeiContent())?->getPath()->relative());
        $updateArchive->setOperatingLicensePath($entityInterface->saveArchivePattern(RandomHelper::getRand(), $updateArchive->getOperatingLicenseContent())?->getPath()->relative());
        $updateArchive->setSocialContractPath($entityInterface->saveArchivePattern(RandomHelper::getRand(), $updateArchive->getSocialContractContent())?->getPath()->relative());

        $entityInterface->updatePath($id, $updateArchive);
    }

    private function buildArchive(?UTF8Content $archiveContent, int $id, $service): void
    {
        $archiveContent ? $service->buildArchive($archiveContent, $id) : null;
    }

    public function download(string $relative)
    {
        try {
            $path = $this->service->preparePath($relative);

            $archive = $this->service->get($path);

            return ArchiveUtil::responseArchive($archive);
        } catch(ArchiveException $arquivoException) {
            throw new NotFoundHttpException();
        }
    }
}
