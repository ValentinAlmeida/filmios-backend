<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ActivityServiceInterface;
use App\Entities\ActivityEntity;
use App\Http\Requests\SearchActivityRequest;
use App\Support\Serializers\ActivitySerializer;

class ActivityController extends Controller
{
    public function __construct(private readonly ActivityServiceInterface $activityServiceInterface) {
    }
    public function search(SearchActivityRequest $searchActivityRequest)
    {
        return array_map(fn (ActivityEntity $activityEntity) => ActivitySerializer::parseEntity($activityEntity),$this->activityServiceInterface->search($searchActivityRequest->getData()));
    }
}
