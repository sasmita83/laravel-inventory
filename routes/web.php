<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterGudangController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('welcome');});

route::get('/login',[LoginController::class,'index'])->middleware('guest')->name('login');
route::post('/login',[LoginController::class,'authenticate'])->name('kirim-data-login');
route::get('/logout',[LoginController::class,'logout'])->name('logout');
route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth');

route::get('/master', [MasterController::class,'index'])
    ->name('master')
    ->middleware('auth');
route::get('/master/barang', [MasterBarangController::class,'index'])
    ->name('master-barang')
    ->middleware('auth');
route::get('/master/kategori', [MasterKategoriController::class,'index'])
    ->name('master-kategori')
    ->middleware('auth');
route::get('/master/gudang', [MasterGudangController::class,'index'])
    ->name('master-gudang')
    ->middleware('auth');

route::get('/master/barang/tambah', [MasterBarangController::class,'create'])
    ->name('master-barang-tambah')
    ->middleware('auth');
route::post('/master/barang/simpan', [MasterBarangController::class,'store'])
    ->name('master-barang-simpan')
    ->middleware('auth');

route::get('/master/barang/hapus/{id}', [MasterBarangController::class,'destroy'])
    ->name('master-barang-hapus')
    ->where('id','[0-9]+')
    ->middleware('auth');

route::get('/master/barang/detail/{id}', [MasterBarangController::class,'show'])
    ->name('master-barang-detail')
    ->where('id','[0-9]+')
    ->middleware('auth');

route::get('/master/barang/edit/{id}', [MasterBarangController::class,'edit'])
    ->name('master-barang-edit')
    ->where('id','[0-9]+')
    ->middleware('auth');

route::post('/master/barang/update/{id}', [MasterBarangController::class,'update'])
    ->name('master-barang-update')
    ->where('id','[0-9]+')
    ->middleware('auth');
route::get('/stok-masuk', [StokController::class,'form_stok_masuk'])
    ->name('stok-masuk')
    ->middleware('auth');

route::post('/stok-in', [StokController::class,'proses_stok_masuk'])
    ->name('stok-in')
    ->middleware('auth');

