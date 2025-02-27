<?php

namespace Database\Seeders;

use App\Models\LocalityModel;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $descriptions = [
            'Salvador',
            'Lauro de Freitas',
            'Lençóis',
            'Lamarão',
        ];

        foreach ($descriptions as $description) {
            LocalityModel::updateOrCreate(
                [LocalityModel::DESCRIPTION => $description],
                [
                    LocalityModel::CREATED_AT => $now,
                    LocalityModel::UPDATED_AT => $now,
                ]
            );
        }
    }
}
