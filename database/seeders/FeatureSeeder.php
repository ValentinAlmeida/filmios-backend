<?php

namespace Database\Seeders;

use App\Core\Enumerations\EstablishmentFeatureEnum;
use App\Core\Enumerations\RequestFeatureEnum;
use App\Core\Enumerations\ResponsibleFeatureEnum;
use App\Core\Enumerations\UserFeatureEnum;
use App\Models\FeatureModel;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $keys = [
            UserFeatureEnum::SEARCH,
            UserFeatureEnum::CREATE,
            UserFeatureEnum::DELETE,
            UserFeatureEnum::UPDATE,
            UserFeatureEnum::FIND,
            ResponsibleFeatureEnum::FIND,
            ResponsibleFeatureEnum::SEARCH,
            ResponsibleFeatureEnum::UPDATE,
            RequestFeatureEnum::UPDATE,
            RequestFeatureEnum::SEARCH,
            RequestFeatureEnum::FIND,
            EstablishmentFeatureEnum::UPDATE,
            EstablishmentFeatureEnum::SEARCH,
            EstablishmentFeatureEnum::FIND,
        ];

        foreach ($keys as $key) {
            FeatureModel::updateOrCreate(
                [FeatureModel::KEY => $key],
                [
                    FeatureModel::CREATED_AT => $now,
                    FeatureModel::UPDATED_AT => $now,
                ]
            );
        }
    }
}
