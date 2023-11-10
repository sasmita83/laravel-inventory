<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use App\Models\StokBarangModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class StokController extends Controller
{
    public function form_stok_masuk()

    {
        $barang = MasterBarangModel::where('status',1)->get();
        return view('stok.form-stok-masuk', compact('barang'));
    }

    public function proses_stok_masuk(Request $request)

    {
        $aturan =[

            'form_barang'         => 'required',
            'form_jumlah_masuk'   => 'required',
        ];
        $pesan_indo = [
            'required' => 'Wajib Diisi!!',
            'min'      => 'minimal :minimal karakter!!',

        ];
          $validator = Validator::make($request->all(),$aturan, $pesan_indo);


        try {

            // jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()){
                return redirect()
                ->route('stok-masuk')
                ->withErrors($validator)->withInput();
            } else {

            //mengambil sisa terakhir dari data database berdasarkan kode barang
            $cek_sisa = StokBarangModel::where('kode', $request->form_barang)
            ->orderBy('id', 'DESC')
            ->first();
            $stok_sisa = $cek_sisa['stok_sisa'] ?? 0;
            //jika ada sisa yang di temukan
            if (isset($stok_sisa)){
            //stok sisa + stok masuk baru
                $isi =$stok_sisa + $request->form_jumlah_masuk;
            } else {
            //jika tidak ada sisa
            //stok sisa mengambil dari data jumlah barang yang masuk
                $isi = $request->form_jumlah_masuk;
            }

            $insert = StokBarangModel::create([

                'kode'                => strtoupper($request->form_barang),
                'stok_masuk'          => $request->form_jumlah_masuk,
                'stok_keluar'         => 0,
                'stok_sisa'           => $isi,
                'dibuat_kapan'        => date('Y-m-d H:i:s'),
                'dibuat_oleh'         => Auth::user()->id,
                'diperbaharui_kapan'  => null,
                'diperbaharui_oleh'   => null,

            ]);
                //jika proses insert berhasil
                if ($insert) {
                    return redirect()
                    ->route('stok-masuk')
                    ->with('success','berhasil memasukan stok');
                }
            }
        }
         catch (\Throwable $th){
            return redirect()
            ->route('stok-masuk')
            ->with('danger',$th->getMessage());
         }

    }

    public function form_stok_keluar()

    {
        $barang = MasterBarangModel::where('status',1)->get();
        return view('stok.form-stok-keluar', compact('barang'));
    }

    public function proses_stok_keluar(Request $request)

    {
        $aturan =[

            'form_barang'         => 'required',
            'form_jumlah_keluar'   => 'required',
        ];
        $pesan_indo = [
            'required' => 'Wajib Diisi!!',
            'min'      => 'minimal :minimal karakter!!',

        ];
          $validator = Validator::make($request->all(),$aturan, $pesan_indo);


        try {

            // jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()){
                return redirect()
                ->route('stok-keluar')
                ->withErrors($validator)->withInput();
            } else {

            //mengambil sisa terakhir dari data database berdasarkan kode barang

            $cek_sisa = StokBarangModel::where('kode', $request->form_barang)
            ->orderBy('id', 'DESC')
            ->first();
            $stok_sisa = $cek_sisa['stok_sisa'] ?? 0;

            //jika ada sisa yang di temukan
            if (isset($stok_sisa)){
                //stok sisa + stok masuk baru

                if($request->form_jumlah_keluar > $stok_sisa){
                    return redirect()
                    ->route('stok-keluar')
                    ->with('danger','Jumlah yang dikeluarkan melebihi stok yang ada');
                    die;
                }
                //jika yang di keluarkan lebih kecil atau sama
                else{
                    if ($request->form_jumlah_keluar <= 0){
                        return redirect()
                        ->route('stok-keluar')
                        ->with('danger','Jumlah Minimal Barang Yang bisa Keluar adalah 1');
                        die;

                    }
                    //jumlah yang keluar 1 dst ...
                    else {
                    $keluar =$stok_sisa - $request->form_jumlah_keluar;
                    $insert = StokBarangModel::create([

                        'kode'                => strtoupper($request->form_barang),
                        'stok_masuk'          => 0,
                        'stok_keluar'         => $request->form_jumlah_keluar,
                        'stok_sisa'           => $keluar,
                        'dibuat_kapan'        => date('Y-m-d H:i:s'),
                        'dibuat_oleh'         => Auth::user()->id,
                        'diperbaharui_kapan'  => null,
                        'diperbaharui_oleh'   => null,

                    ]);
                        //jika proses insert berhasil
                        if ($insert) {
                            return redirect()
                            ->route('stok-keluar')
                            ->with('success','berhasil Mengeluarkan Barang stok');
                        }
                }
            }

            } else {
            //jika tidak ada sisa
            //stok sisa mengambil dari data jumlah barang yang masuk
                $keluar = $request->form_jumlah_keluar;
            }

            }
        }
         catch (\Throwable $th){
            return redirect()
            ->route('stok-keluar')
            ->with('danger',$th->getMessage());
         }
}
}
