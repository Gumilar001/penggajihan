<?php

namespace App\Imports;

use App\Models\Pangkat;
use App\Models\PersonelPns;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UsersImportPangkat implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {

            $user_pangkat = Pangkat::create([
                'nama_pangkat' => $row['nama_pangkat'],
                'golongan' => $row['golongan'],
                'jenis' => $row['jenis'],
            ]);
    
            return $user_pangkat;
        } catch (\Throwable $th) {
            dd($th);
        }
       
    }
}