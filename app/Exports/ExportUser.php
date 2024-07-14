<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Spatie\Permission\Models\Role;

class ExportUser implements FromCollection, WithHeadings, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $users = User::with('companies.company')->get();
        $no = 1;
        $data = [];
        foreach ($users as $user) {
            if ($user->is_active == 1) {
                $status = 'Aktif';
            } else {
                $status = 'Tidak Aktif';
            }

            $role_name = Role::where('id', $user->role_id)->first();
            $role_name = $role_name->name ?? '-';

            array_push($data, [
                $no,
                $user->name,
                $user->username,
                $role_name,
                $status,
            ]);
            $no++;
        }
        return collect($data);

    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Username',
            'Peran',
            'Status',
            'Perusahaan'
        ];
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT
        ];
    }
}