<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonelTni extends Model
{
    use HasFactory;
    protected $table='personel_tni';
    protected $fillable = [
        'id',
        'nrp',
        'nama_tni',
        'tgl_lahir',
        'npwp',
        'status_menikah',
        'jumlah_anak',
        'gajih_pokok',
        'id_pangkat_tni',
        'no_whatsapp'
    ];

    public function pangkatTniId() {
        return $this->hasOne('\App\Models\Pangkat', 'id', 'id_pangkat_tni');
    }
    public function penggajianTni() {
        return $this->hasOne('\App\Models\PenggajihanTni', 'id_personel_tni','id');
    }
}
