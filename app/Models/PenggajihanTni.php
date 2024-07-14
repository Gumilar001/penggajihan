<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggajihanTni extends Model
{
    use HasFactory;
    protected $table = 'penggajihan_tni';
    protected $fillable = [
        'id',
        'id_personel_tni',
        'bulan_penggajihan',
        'gapok',
        't_keluarga',
        't_anak',
        'g_bruto',
        't_struktural',
        't_fungsional',
        't_umum',
        't_beras',
        't_kowan',
        't_sandi',
        't_babinsa',
        't_papua',
        't_terluar',
        't_lainnya',
        't_tpp',
        't_pph',
        'pot_pembulatan',
        'penghasilan_kotor',
        'p_beras',
        'p_pensiunan',
        'p_bpjs',
        'p_tht',
        'p_bpjs_lainnya',
        'p_sewa_rumah',
        'pot_lainnya',
        'jumlah_potongan',
        'penghasilan_bersih',
        'laukpauk',
        'raymond'
    ];

    public function PersonelTni() {
        return $this->hasOne('\App\Models\PersonelTni', 'id', 'id_personel_tni');
    }
    
}
