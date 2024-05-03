<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('4dminins4n'),
                'level' => 1
            ],
            [
                'name' => 'kasir1',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('k4s1rins4n'),
                'level' => 2
            ],
            [
                'name' => 'owner',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('0wn3rc4f3'),
                'level' => 3
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
