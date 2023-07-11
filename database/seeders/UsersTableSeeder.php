<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            [
                'name'      => 'Stefano',
                'email'     => 'stefe68@gmail.com',
                'password'  => Hash::make('evermore'),
            ],
            [
                'name'      => 'Laura',
                'email'     => $faker->safeEmail(),
                'password'  => Hash::make('Laura_1111'),
            ],
            [
                'name'      => 'Giuseppe',
                'email'     => $faker->safeEmail(),
                'password'  => Hash::make('Giuseppe_1111'),
            ],
            [
                'name'      => 'Elena',
                'email'     => $faker->safeEmail(),
                'password'  => Hash::make('Elena_1111'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
