<?php

namespace App\Http\Services;
use Spatie\Permission\Models\Permission;

class PermissionService {
    public function get()
    {
        $data = Permission::get();
        return $data;
    }
    public function create($data)
    {
        
    }
    public function findById($id)
    {
        
    }
    public function update($id, $data)
    {
        
    }
    public function destory($id)
    {
        
    }
}