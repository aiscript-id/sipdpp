<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attr = [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
        ];

        $user = User::create($attr);
        $user->assignRole('superadmin');

        $attr = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ];

        $user = User::create($attr);
        $user->assignRole('admin');
        $attr = [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
        ];

        $user = User::create($attr);
        $user->assignRole('user');

        // create 10 users
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $attr = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ];

            $user = User::create($attr);
            $user->assignRole('user');
        }

    }
}
