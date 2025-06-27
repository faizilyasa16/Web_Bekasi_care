<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'terafiliasi',
            'nik' => '999999999999',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'status' => 'terafiliasi',
            'password' => bcrypt('password'),
            'nik' => '085695587847',
        ]);
    }
}
