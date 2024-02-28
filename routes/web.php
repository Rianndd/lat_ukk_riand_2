<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// //Login
// Route::get('/', [LoginController::class, 'index']);
// Route::get('/', [LoginController::class, 'login']);

//Dashboard
Route::resource('/', DashboardController::class);

//Kategori
Route::resource('kategori', KategoriController::class);

//Satuan
Route::resource('satuan', SatuanController::class);

//produk
Route::resource('produk', ProdukController::class);

//user
Route::resource('users', UsersController::class);

//Supplier
Route::resource('supplier', SupplierController::class);

//Pelanggan
Route::resource('pelanggan', PelangganController::class);

//Pembelian Stok
Route::resource('pembelian', PembelianController::class);
Route::get('pembelian/{id_supplier}', 'PembelianController@show')->name('pembelian.show');

//transaksi
Route::resource('transaksi', TransaksiController::class);

//transaksi detail
Route::resource('transaksi_detail', TransaksiDetailController::class);
// Route::get('transaksi/{id_transaksi_}/edit', 'TransaksiController@edit')->name('transaksi.edit');

//temp
Route::resource('temp', TempController::class);