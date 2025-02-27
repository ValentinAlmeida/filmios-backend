<?php

namespace Database\Factories;

use App\Core\Enumerations\ProfileEnum;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        $now = Carbon::now();

        return [
            UserModel::LOGIN => $this->faker->numerify('###########'),
            UserModel::EMAIL => $this->faker->unique()->safeEmail(),
            UserModel::PASSWORD => Hash::make('12345678'),
            UserModel::ACTIVE => 1,
            UserModel::NAME => $this->faker->name(),
            UserModel::BLOCK => 0,
            UserModel::CREATED_AT => $now,
            UserModel::UPDATED_AT => $now,
        ];
    }

    public static function createUsers(int $amount)
    {
        return UserModel::factory()->count($amount)->create();
    }
}
