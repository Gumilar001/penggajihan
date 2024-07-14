<?php

namespace App\Imports;

use App\Models\Pangkat;
use App\Models\PersonelPns;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImportPersonelPns implements ToModel, WithHeadingRow
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

            $user_personel_tni = PersonelPns::create([
                'nrp' => $row['nrp'],
                'nama_pns' => $row['nama_pns'],
                'tgl_lahir' => $row['tgl_lahir'],
                'npwp' => $row['npwp'],
                'status_menikah' => $row['status_menikah'],
                'jumlah_anak' => $row['jumlah_anak'],
                'gajih_pokok' => $row['gajih_pokok'],
                'id_pangkat' => $pangkat->id,
                'no_whatsapp' => $row['no_whatsapp'],
            ]);
    
            return $user_personel_tni;
        } catch (\Throwable $th) {
            dd($th);
        }
       
    }
}