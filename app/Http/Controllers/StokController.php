<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;

class StokController extends Controller
{
    public function form_stok_masuk()

    {
        $barang = MasterBarangModel::where('status',1)->get();
        return view('stok.form-stok-masuk', compact('barang'));
    }
}
