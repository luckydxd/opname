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

{
    User::create([
        'name' => 'Admin',
        'email' => 'Admin@gmail.com',
        'password' => bcrypt('Admin#123'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'User',
        'email' => 'User@gmail.com',
        'password' => bcrypt('User#123'),
        'role' => 'user',
    ]);
}

    }
}
