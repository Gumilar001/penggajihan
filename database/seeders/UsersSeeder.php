<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'is_active' => 1,
        ]);

        $admin->assignRole('superadmin');

        $user = User::create([
            'name' => 'User',
            'username' => 'user',
            'password' => bcrypt('password'),
            'is_active' => 1,
        ]);

        // $user->assignRole('proyek');
    }
}