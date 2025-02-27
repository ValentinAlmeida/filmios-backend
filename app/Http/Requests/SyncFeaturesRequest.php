<?php

namespace App\Http\Requests;

use App\Core\DTO\SyncFeaturesDTO;
use App\Core\Enumerations\ProfileEnum;
use App\Support\Manager\FeatureManager;

class SyncFeaturesRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'features' => ['required', 'array'],
            'features.*' => ['required', 'string', FeatureManager::rule()],
            'profile_key' => ['required', 'string', ProfileEnum::rule()],
        ];
    }

    public function getData(): SyncFeaturesDTO
    {
        return new SyncFeaturesDTO(
            $this->input('features'),
            $this->input('profile_key'),
        );
    }
}
