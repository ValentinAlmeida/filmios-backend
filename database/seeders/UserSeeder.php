<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $usuarioData = [
            UserModel::LOGIN => '12345678901',
            UserModel::EMAIL => 'john.doe@example.com',
            UserModel::PASSWORD => Hash::make('12345678'),
            UserModel::ACTIVE => 1,
            UserModel::NAME => 'John Vlogs',
            UserModel::BLOCK => 0,
            UserModel::CREATED_AT => $now,
            UserModel::UPDATED_AT => $now,
        ];

        UserModel::updateOrCreate(
            [UserModel::LOGIN => $usuarioData[UserModel::LOGIN]],
            $usuarioData
        );
    }
}
