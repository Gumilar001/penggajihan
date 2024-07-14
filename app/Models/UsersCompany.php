<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCompany extends Model
{
    use HasFactory;

    protected $table = 'users_company';

    protected $fillable = [
        'id',
        'user_id',
        'company_id'
    ];
    public function user()
    {
        return $this->hasOne('\App\Models\Users', 'id', 'user_id');
    }
    public function company_id()
    {
        return $this->hasOne('\App\Models\Company', 'id', 'company_id');
    }
    public function company()
    {
        return $this->hasOne('\App\Models\Company', 'id', 'company_id');
    }


}