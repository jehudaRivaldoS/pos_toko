<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductTintingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiProductTintingController;
use App\Models\ProductTinting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

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

route::get('/', function () {
    return view('welcome');
})->middleware('auth');

route::get('/transaksi', function () {
    return view('transaksi');
})->middleware('auth');

Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::get('/tambahbarang', [BarangController::class, 'shows'])->middleware('auth');
Route::get('/datatinting', [ProductTintingController::class, 'index'])->middleware('auth');
Route::get('/tambahtinting', [ProductTintingController::class, 'shows'])->middleware('auth');
Route::get('/transaksitinting', [ProductTintingController::class, 'addTransaksi'])->middleware('auth');
Route::post('/tinting/store', [TransaksiProductTintingController::class, 'store'])->middleware('auth');
Route::get('/laporantinting', [TransaksiProductTintingController::class, 'index'])->middleware('auth');
Route::post('/laporantransaksi/edits/{id}', [TransaksiController::class, 'ubahStatus'])->name('transaction.edits');
Route::delete('/laporantransaksi/hapus/{id}', [TransaksiController::class, 'hapusTransaksi'])->name('transaction.hapusTransaksi');
Route::get('/laporantransaksi/detail/{id}', [TransaksiController::class, 'indexDetail'])->name('transaction.detail')->middleware('auth');
Route::get('/customer', [CustomerController::class, 'index'])->middleware('auth');
Route::post('/cart/store', [TransaksiController::class, 'store'])->name('cart.store')->middleware('auth');
Route::post('/transaction/store', [TransaksiController::class, 'storeTransaksi'])->name('transaction.storeTransaksi');
Route::get('/laporantransaksi', [TransaksiController::class, 'indexLaporan'])->middleware('auth');
Route::get('/delete/{id}', [BarangController::class, 'deleteBarang'])->middleware('auth');
Route::get('/deleted/{id}', [TransaksiProductTintingController::class, 'deleteBarang'])->middleware('auth');
Route::get('/deletetinting/{id}', [BarangController::class, 'deleteBarang'])->middleware('auth');
Route::get('/deletetransaksi/{id}', [TransaksiController::class, 'deleteBarang'])->middleware('auth');
Route::get('/clear-cart', [TransaksiController::class, 'clearCart'])->name('transaksi.clear');

Route::resource('barang', BarangController::class)->middleware('auth');
Route::resource('transaksi', TransaksiController::class)->middleware('auth');
Route::resource('productinting', ProductTintingController::class)->middleware('auth');
Route::resource('tinting', TransaksiProductTintingController::class)->middleware('auth');
Route::resource('customer', CustomerController::class)->middleware('auth');

Route::post('/modalEdit', [BarangController::class, 'editshow'])->middleware('auth');
Route::post('/modalEditTinting', [ProductTintingController::class, 'editshow'])->middleware('auth');

Auth::routes();