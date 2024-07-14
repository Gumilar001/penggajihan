<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $role = DB::raw('role_has_permissions');

        $user = User::create([
            'name' => $row['nama'],
            'is_active' => 1,
            'username' => $row['username'],
            'password' => $row['password'],
            'role_id' => $row['peran'],
        ]);

        $role_name = $row['peran'];
        $role = Role::where('name', '=', $role_name)->first();
        $role_id = null;
        if ($role) {
            $role_id = $role->id;
        }
        if (isset($role_id))
            $user->assignRole($role_id);


        // $user->assignRole('role_id' , $row['peran']);
        return $user;
    }
}