<?php

namespace Database\Seeders;

use App\Models\MasterPermission;
use Illuminate\Database\Seeder;
use DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Data Personel',
                'icon' => 'document.svg',
                'feature' => [
                    'view personel tni',
                    'add personel tni',
                    'edit personel tni',
                    'delete personel tni',
                    'view personel pns',
                    'add personel pns',
                    'edit personel pns',
                    'delete personel pns',
                ]
            ],
            [
                'title' => 'Data Laporan',
                'icon' => 'document.svg',
                'feature' => [
                    'view laporan tni',
                    'view laporan pns',
                ]
            ],
            [
                'title' => 'Data Penggajihan',
                'icon' => 'document.svg',
                'feature' => [
                    'view penggajihan tni',
                    'add penggajihan tni',
                    'edit penggajihan tni',
                    'delete penggajihan tni',
                    'view penggajihan pns',
                    'add penggajihan pns',
                    'edit penggajihan pns',
                    'delete penggajihan pns',
                ]
            ],
            [
                'title' => 'Users',
                'icon' => 'user.svg',
                'feature' => [
                    'view users',
                    'create users',
                    'edit users',
                    'delete users',
                    'view role',
                    'create role',
                    'edit role',
                    'delete role'
                ]
            ],
        ];

        foreach ($data as $key => $value) {
            $check = MasterPermission::where('permission_title', $value['title'])->first();
            if (!$check) {
                $check = MasterPermission::create(
                    [
                        'permission_title' => $value['title'],
                        'icon' => $value['icon']
                    ]
                );
            }
            foreach ($value['feature'] as $key => $val) {
                $checkChild = DB::table('permissions')->where('name', $val)
                    ->first();

                if (!$checkChild) {
                    $checkChild = DB::table('permissions')
                        ->insert([
                            "name" => $val,
                            "guard_name" => "web",
                            "master_permission_id" => $check->id
                        ]);
                }
            }
            // DB::table('role_has_permissions')
            //     ->insert([
            //         'role_id' => '1',
            //         'permission_id' => '1'
            //     ]);
        }
    }
}