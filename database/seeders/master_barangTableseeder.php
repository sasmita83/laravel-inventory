<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class master_barangTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_barang')->insert([
            [
                'kode'              => 'TGO-KLG',
                'nama'             => ' tanggo kaleng',
                'deskripsi'         => 'wafer tanggo kemasan kaleng',
                'id_kategori'       => null,
                'id_gudang'         => null,
                'dibuat_kapan'      => date('Y-m-d H:i:s'),
                'dibuat_oleh'       => 1,
                'diperbaharui_kapan'=> null,
                'diperbaharui_oleh' => null,

            ],
            [
                'kode'              => 'TGO-SAC',
                'nama'             => ' tanggo sachet',
                'deskripsi'         => 'wafer tanggo kemasan sachet',
                'id_kategori'       => null,
                'id_gudang'         => null,
                'dibuat_kapan'      => date('Y-m-d H:i:s'),
                'dibuat_oleh'       => 1,
                'diperbaharui_kapan'=> null,
                'diperbaharui_oleh' => null,

            ],

        ]);
    }
}
