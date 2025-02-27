<?php

namespace Database\Seeders;

use App\Core\Enumerations\ProfileEnum;
use App\Models\ProfileModel;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $descriptions = [
            ProfileEnum::REGULADO,
            ProfileEnum::FISCAL,
            ProfileEnum::GESTOR,
            ProfileEnum::ADMINISTRADOR
        ];

        foreach ($descriptions as $description) {
            ProfileModel::updateOrCreate(
                [ProfileModel::KEY => $description],
                [
                    ProfileModel::CREATED_AT => $now,
                    ProfileModel::UPDATED_AT => $now,
                ]
            );
        }
    }
}
