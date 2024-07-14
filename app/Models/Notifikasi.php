<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
        'user_id_pengirim',
        'user_id_penerima',
        'role',
        'created_at',
        'is_read'
    ];

    public function userpengirim()
    {
        return $this->hasOne('\App\Models\Users', 'id', 'user_id_pengirim');
    }
    public function userpenerima()
    {
        return $this->hasOne('\App\Models\Users', 'id', 'user_id_penerima');
    }
}
