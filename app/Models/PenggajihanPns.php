<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggajihanPns extends Model
{
    use HasFactory;
    protected $table='penggajihan_pns';
    protected $fillable = [
        'id',
        'id_personel_pns',
        'bulan_penggajihan',
        'gapok',
        't_keluarga',
        't_anak',
        't_umum_tambahan',
        't_umum',
        't_papua',
        't_terpencil',
        't_jabatan',
        't_beras',
        't_khusus_pajak',
        'penghasilan_kotor',
        'pot_pembulatan',
        'pot_beras',
        'pot_pensiunan',
        'pot_bpjs',
        'pot_tht',
        'pot_pajak_penghasilan',
        'pot_sewa_rmh',
        'pot_tunggakan_hutang',
        'pot_lebih',
        'pot_lain_taperrum',
        'jumlah_potongan',
        'penghasilan_bersih',
        'remon',
        't_tpp_pns'
    ];

    public function PersonelId() {
        return $this->hasOne('\App\Models\PersonelPns', 'id','id_personel_pns');
    }
}
