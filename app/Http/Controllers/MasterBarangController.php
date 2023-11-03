<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        //proses ambil data dari mysql
        $barang = MasterBarangModel::where('status',1)->get();
        return view('master.barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.barang.form-tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request)

        $aturan =[

            'html_kode'         => 'required|min:3|max:7|alpha_dash|unique:master_barang,kode',
            'html_nama'         => 'required|min:10|max:25',
            'html_deskripsi'    => 'required|max:225',
        ];
        $pesan_indo = [
            'required' => 'Wajib Diisi!!',
            'min'      => 'minimal :minimal karakter!!',
            'unique'    =>  'Kode Barang Sudah Terpakai',

        ];
            $validator = validator::make($request->all(),$aturan, $pesan_indo);

        try {

            // jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()){
                return redirect()
                ->route('master-barang-tambah')
                ->withErrors($validator)->withInput();
            }else{


            $insert = MasterBarangModel::create([

                'kode'                => strtoupper($request->html_kode),
                'nama'                => strtoupper($request->html_nama),
                'deskripsi'           => $request->html_deskripsi,
                'id_kategori'         => null,
                'id_gudang'           => null,
                'dibuat_kapan'        => date('Y-m-d H:i:s'),
                'dibuat_oleh'         => Auth::user()->id,
                'diperbaharui_kapan'  => null,
                'diperbaharui_oleh'   => null,

            ]);
                //jika proses insert berhasil
                if ($insert) {
                    return redirect()
                    ->route('master-barang')
                    ->with('success','berhasil menambahkan barang baru');
                }
            }
        }
         catch (\Throwable $th){
            return redirect()
            ->route('master-barang-tambah')
            ->with('danger',$th->getMessage());

         }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$barang = MasterBarangModel::where(['id'=>$id])->first();

        $barang = DB::select(
            "SELECT
            mba.*,
            u1.name as dibuat_nama, u1.email as dibuat_email,
            u2.name as diperbaharui_nama, u2.email as diperbaharui_email
            FROM master_barang as mba
            LEFT JOIN users as u1 on mba.dibuat_oleh = u1.id
            LEFT JOIN users as u2 on mba.diperbaharui_oleh = u2.id
            Where mba.id = ?;",
            [$id]

        );

        return view('master.barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = DB::select(
            "SELECT
            mba.*,
            u1.name as dibuat_nama, u1.email as dibuat_email,
            u2.name as diperbaharui_nama, u2.email as diperbaharui_email
            FROM master_barang as mba
            LEFT JOIN users as u1 on mba.dibuat_oleh = u1.id
            LEFT JOIN users as u2 on mba.diperbaharui_oleh = u2.id
            Where mba.id = ?;",
            [$id]

        );

        return view('master.barang.form-edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aturan =[

            'html_nama'         => 'required|min:10|max:25',
            'html_deskripsi'    => 'required|max:225',
        ];
        $pesan_indo = [
            'required' => 'Wajib Diisi!!',
            'min'      => 'minimal :minimal karakter!!',
            'unique'    =>  'Kode Barang Sudah Terpakai',

        ];
            $validator = validator::make($request->all(),$aturan, $pesan_indo);

        try {

            // jika inputan user tidak sesuai dengan aturan validasi
            if ($validator->fails()){
                return redirect()
                ->route('master-barang-edit',$id)
                ->withErrors($validator)->withInput();
            }else{


            $update = MasterBarangModel::where('id',$id)->update([

                'nama'                => strtoupper($request->html_nama),
                'deskripsi'           => $request->html_deskripsi,
                'diperbaharui_kapan'  => date('Y-m-d H:i:s'),
                'diperbaharui_oleh'   => Auth::user()->id,

            ]);
                //jika proses insert berhasil
                if ($update) {
                    return redirect()
                    ->route('master-barang')
                    ->with('success','Master Barang Berhasil Di Edit');
                }
            }
        }
         catch (\Throwable $th){
            return redirect()
            ->route('master-barang-edit',$id)
            ->with('danger',$th->getMessage());

         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_barang)
    {
        try {




            $update = MasterBarangModel::where(['id'=>$id_barang])
            ->update([
                'status'=>0,

            ]);

                //jika proses insert berhasil
                if ($update) {
                    return redirect()
                    ->route('master-barang')
                    ->with('success','berhasil menghapus barang');

                }
            }
            catch (\Throwable $th){
               return redirect()
               ->route('master-barang')
               ->with('danger',$th->getMessage());

            }

        }

}
