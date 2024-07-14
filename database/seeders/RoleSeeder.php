<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listRole = ['superadmin', 'admin', 'staff'];

        foreach ($listRole as $key => $value) {
            Role::create([
                'name' => $value,
                'guard_name' => 'web'
            ]);
        }
    }
}