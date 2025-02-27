<?php

namespace Database\Seeders;

use App\Models\CnaeModel;
use Illuminate\Database\Seeder;

class CnaeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(database_path("data/tvs_2024.csv"), "r")) !== FALSE) {
            $firstRow = true;

            while (($line = fgetcsv($handle, 0, ",")) !== FALSE) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $data = [
                    CnaeModel::CODE => $line[0],
                    CnaeModel::DESCRIPTION => $line[1],
                ];

                CnaeModel::updateOrInsert([CnaeModel::CODE => $line[0]], $data);
            }
            fclose($handle);
        }
    }
}
