<?php

namespace Database\Seeders;

use App\Core\Enumerations\ProfileEnum;
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
            UserModel::CPF => '12345678901',
            UserModel::EMAIL => 'john.doe@example.com',
            UserModel::PASSWORD => Hash::make('12345678'),
            UserModel::PROFILE_KEY => ProfileEnum::ADMINISTRADOR->value,
            UserModel::ACTIVE => 1,
            UserModel::NAME => 'John Vlogs',
            UserModel::TELEPHONE => '71981903806',
            UserModel::BLOCK => 0,
            UserModel::CREATED_AT => $now,
            UserModel::UPDATED_AT => $now,
        ];

        UserModel::updateOrCreate(
            [UserModel::CPF => $usuarioData[UserModel::CPF]],
            $usuarioData
        )->localities()->sync([1, 2]);
    }
}
