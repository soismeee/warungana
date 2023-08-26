<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\RekapanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

route::get('/', [HomeController::class, 'index'])->middleware('auth');
route::get('/json_harian', [HomeController::class, 'json_harian'])->name('json_harian')->middleware('auth');
// route data master
route::resource('/usr', UserController::class)->middleware('auth');
route::post('/json_usr', [UserController::class, 'json'])->name('json_usr')->middleware('auth');
route::resource('/kb', KategoriController::class)->middleware('auth');
Route::post('/json_kb', [KategoriController::class, 'json'])->name('json_kb')->middleware('auth');
route::resource('/b', BarangController::class)->middleware('auth');
route::post('/json_b', [BarangController::class, 'json'])->middleware('auth');

// route transaksi
route::get('/dt', [TransaksiController::class, 'index'])->name('dt')->middleware('auth');
route::get('/t', [TransaksiController::class, 'create'])->name('t')->middleware('auth');
route::get('/get_brg/{id}', [TransaksiController::class, 'getBarang'])->name('get_brg')->middleware('auth');
route::get('/sh_t/{id}', [TransaksiController::class, 'show'])->name('sh_t')->middleware('auth');
route::get('/pr/{id}', [TransaksiController::class, 'print'])->name('pr')->middleware('auth');
route::post('/save', [TransaksiController::class, 'store'])->name('save')->middleware('auth');
route::post('/json_dt', [TransaksiController::class, 'json'])->name('json_dt')->middleware('auth');
route::delete('/del_t/{id}', [TransaksiController::class, 'destroy'])->name('del_t')->middleware('auth');

// route pembelian
route::resource('/pb', PembelianController::class)->middleware('auth');
route::post('/json_pb', [PembelianController::class, 'json'])->name('json_pb')->middleware('auth');

// route rekap laporan
route::get('rh', [RekapanController::class, 'harian'])->name('rh')->middleware('auth');
route::get('rb', [RekapanController::class, 'bulanan'])->name('rb')->middleware('auth');
route::get('rt', [RekapanController::class, 'tahunan'])->name('rt')->middleware('auth');
route::get('get_pph', [RekapanController::class, 'getRekapHarian'])->name('get_pph')->middleware('auth');
route::post('/json_rh', [RekapanController::class, 'json_harian'])->name('json_rh')->middleware('auth');
route::get('get_ppb', [RekapanController::class, 'getRekapBulanan'])->name('get_ppb')->middleware('auth');
route::get('/sd_rb', [RekapanController::class, 'getDetailRekapBulanan'])->name('sd_rb')->middleware('auth');
route::post('/json_rb', [RekapanController::class, 'json_bulanan'])->name('json_rb')->middleware('auth');
route::get('get_ppt', [RekapanController::class, 'getRekapTahunan'])->name('get_ppt')->middleware('auth');
route::get('/json_rt', [RekapanController::class, 'json_tahunan'])->name('json_rt')->middleware('auth');
