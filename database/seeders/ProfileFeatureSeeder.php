<?php

namespace Database\Seeders;

use App\Core\Enumerations\ProfileEnum;
use App\Models\FeatureModel;
use App\Models\ProfileFeatureModel;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProfileFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $adminProfileId = ProfileEnum::ADMINISTRADOR;

        $features = FeatureModel::all();

        foreach ($features as $feature) {
            ProfileFeatureModel::updateOrCreate(
                [
                    ProfileFeatureModel::PROFILE_KEY => $adminProfileId,
                    ProfileFeatureModel::FEATURE_KEY => $feature->key,
                ],
                [
                    ProfileFeatureModel::CREATED_AT => $now,
                    ProfileFeatureModel::UPDATED_AT => $now,
                ]
            );
        }
    }
}
