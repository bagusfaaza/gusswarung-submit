<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('password123')
            ],
            [
                'name' => 'pelanggan',
                'email' => 'user@gmail.com',
                'role' => 'user',
                'password' => bcrypt('password123')
            ],
            [
                'name' => 'driver',
                'email' => 'driver@gmail.com',
                'role' => 'driver',
                'password' => bcrypt('password123')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}