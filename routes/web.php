<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
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
