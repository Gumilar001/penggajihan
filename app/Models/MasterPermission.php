<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPermission extends Model
{ 
    use HasFactory;

    protected $fillable = ['permission_title'];



    public function permission()
    {
        return $this->hasMany('\Spatie\Permission\Models\Permission','master_permission_id', 'id');
    }
}
