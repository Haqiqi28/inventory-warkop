<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name_user' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name_user' => 'Master',
            'username' => 'master',
            'password' => Hash::make('password'),
            'role' => 'master',
        ]);
    }
}
