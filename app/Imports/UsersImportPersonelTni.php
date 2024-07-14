<?php

namespace App\Imports;

use App\Models\Pangkat;
use App\Models\PersonelTni;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImportPersonelTni implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $pangkat = Pangkat::where('nama_pangkat', $row['pangkat'])->first();

            // dd($pangkat);
            
            $user_personel_tni = PersonelTni::create([
                'nrp' => $row['nrp'],
                'nama_tni' => $row['nama_tni'],
                'tgl_lahir' => $row['tgl_lahir'],
                'npwp' => $row['npwp'],
                'status_menikah' => $row['status_menikah'],
                'jumlah_anak' => $row['jumlah_anak'],
                'gajih_pokok' => $row['gajih_pokok'],
                'id_pangkat_tni' => $pangkat->id,
                'no_whatsapp' => $row['no_whatsapp'],
            ]);
    
            return $user_personel_tni;
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
       
    }
}