<?php


namespace App\Http\Services;

use \Carbon\Carbon;
use DB;
use Spatie\Permission\Models\Role;

class RoleService {
    public function optionsRole()
    {
        $data = Role::get();
        $data = $data->map(function ($roles){
            return collect($roles->toArray())
            ->only(['id','name'])
            ->all();
        });
        return $data;
    }
}
