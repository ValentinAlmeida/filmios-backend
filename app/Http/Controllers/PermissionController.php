<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PermissionServiceInterface;
use App\Entities\FeatureEntity;
use App\Entities\ProfileEntity;
use App\Http\Requests\SearchFeatureRequest;
use App\Http\Requests\SyncFeaturesRequest;
use App\Support\Serializers\EnumSerializer;

class PermissionController extends Controller
{
    public function __construct(private readonly PermissionServiceInterface $permitionService){}

    public function sync(SyncFeaturesRequest $request)
    {
        $this->permitionService->sync($request->getData());

        return response(null, 201);
    }

    public function searchFeatures(SearchFeatureRequest $request)
    {
        return response()->json(array_map(fn (FeatureEntity $feature) => EnumSerializer::parseEntity($feature), $this->permitionService->searchFeatures($request->getData())));
    }

    public function searchProfiles()
    {
        return response()->json(array_map(fn (ProfileEntity $feature) => EnumSerializer::parseEntity($feature), $this->permitionService->searchProfiles()));
    }
}
