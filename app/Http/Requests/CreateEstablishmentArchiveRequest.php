<?php

namespace App\Http\Requests;

use App\Core\DTO\UpdateArchiveEstablishmentDTO;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;

class CreateEstablishmentArchiveRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'identification_document_path', 'operating_license_path', 'social_contract_path', 'mei_path' => [
                'sometimes',
                'file',
                'mimes:pdf',
                'max:11264'
            ]
        ];
    }

    public function getArchiveContent(): UpdateArchiveEstablishmentDTO
    {
        $updateArchiveEstablishmentDTO = new UpdateArchiveEstablishmentDTO();

        $this->has('identification_document_path') ? $updateArchiveEstablishmentDTO->setIdentificationDocumentContent(UTF8Content::make($this->file('identification_document_path')->getContent())) : null;
        $this->has('operating_license_path') ? $updateArchiveEstablishmentDTO->setOperatingLicenseContent(UTF8Content::make($this->file('operating_license_path')->getContent())) : null;
        $this->has('social_contract_path') ? $updateArchiveEstablishmentDTO->setSocialContractContent(UTF8Content::make($this->file('social_contract_path')->getContent())) : null;
        $this->has('mei_path') ? $updateArchiveEstablishmentDTO->setMeiContent(UTF8Content::make($this->file('mei_path')->getContent())) : null;

        return $updateArchiveEstablishmentDTO;
    }
}
