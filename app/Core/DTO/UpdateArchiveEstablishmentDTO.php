<?php

namespace App\Core\DTO;

use App\Infra\FileSystem\LaravelStorage\Path;
use App\Infra\FileSystem\LaravelStorage\UTF8Content;

class UpdateArchiveEstablishmentDTO
{
    private ?UTF8Content $identification_document_content = null;
    private ?UTF8Content $operating_license_content = null;
    private ?UTF8Content $social_contract_content = null;
    private ?UTF8Content $mei_content = null;
    private string|Path|null $identification_document_path = null;
    private string|Path|null $operating_license_path = null;
    private string|Path|null $social_contract_path = null;
    private string|Path|null $mei_path = null;

    public function getIdentificationDocumentContent(): ?UTF8Content
    {
        return $this->identification_document_content;
    }

    public function setIdentificationDocumentContent(?UTF8Content $identification_document_content): void
    {
        $this->identification_document_content = $identification_document_content;
    }

    public function getOperatingLicenseContent(): ?UTF8Content
    {
        return $this->operating_license_content;
    }

    public function setOperatingLicenseContent(?UTF8Content $operating_license_content): void
    {
        $this->operating_license_content = $operating_license_content;
    }

    public function getSocialContractContent(): ?UTF8Content
    {
        return $this->social_contract_content;
    }

    public function setSocialContractContent(?UTF8Content $social_contract_content): void
    {
        $this->social_contract_content = $social_contract_content;
    }

    public function getMeiContent(): ?UTF8Content
    {
        return $this->mei_content;
    }

    public function setMeiContent(?UTF8Content $mei_content): void
    {
        $this->mei_content = $mei_content;
    }

    public function getIdentificationDocumentPath(): string|Path|null
    {
        return $this->identification_document_path;
    }

    public function setIdentificationDocumentPath(string|Path|null $identification_document_path): void
    {
        $this->identification_document_path = $identification_document_path;
    }

    public function getOperatingLicensePath(): string|Path|null
    {
        return $this->operating_license_path;
    }

    public function setOperatingLicensePath(string|Path|null $operating_license_path): void
    {
        $this->operating_license_path = $operating_license_path;
    }

    public function getSocialContractPath(): string|Path|null
    {
        return $this->social_contract_path;
    }

    public function setSocialContractPath(string|Path|null $social_contract_path): void
    {
        $this->social_contract_path = $social_contract_path;
    }

    public function getMeiPath(): string|Path|null
    {
        return $this->mei_path;
    }

    public function setMeiPath(string|Path|null $mei_path): void
    {
        $this->mei_path = $mei_path;
    }
}
