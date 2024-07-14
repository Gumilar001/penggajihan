<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonelPns extends Model
{
    use HasFactory;
    protected $table='personel_pns';
    protected $fillable = [
        'id',
        'nrp',
        'nama_pns',
        'tgl_lahir',
        'npwp',
        'status_menikah',
        'jumlah_anak',
        'gajih_pokok',
        'id_pangkat',
        'no_whatsapp'
    ];

    public function pangkatId(){
        return $this->hasOne('\App\Models\Pangkat', 'id','id_pangkat');
    }

    public function penggajian() {
        return $this->hasOne('\App\Models\PenggajihanPns', 'id_personel_pns','id');
    }
}
