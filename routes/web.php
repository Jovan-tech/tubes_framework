<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\PenelitianAController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\PenelitianBController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PICController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JurnalController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');

// route untuk validasi login
Route::post('/validasi_login', [App\Http\Controllers\LoginController::class, 'show']);

// route selamat
Route::get('/selamat', function () {
    return view('selamat',['nama'=>'Hendro Jokondo-kondo']);
});

// route contoh1
Route::get('/contoh1', [App\Http\Controllers\Contoh1Controller::class, 'show']);
Route::get('teshelpercustom', [App\Http\Controllers\Contoh1Controller::class, 'teshelpercustom']);
Route::get('contohdom', [App\Http\Controllers\Contoh1Controller::class,'contohdom']);
Route::get('contohajax', [App\Http\Controllers\Contoh1Controller::class,'contohajax']);
Route::get('contoh1/pdf', [App\Http\Controllers\Contoh1Controller::class,'tescetakpdf']);
Route::get('contoh1/teshelperlaravel', [App\Http\Controllers\Contoh1Controller::class,'teshelperlaravel']);
Route::get('pembayaranview', [App\Http\Controllers\PembayaranController::class,'show']);
Route::get('pembayaranviewapproval', [App\Http\Controllers\PembayaranController::class,'shows']);
// route contoh2
Route::get('/contoh2', [App\Http\Controllers\Contoh2Controller::class, 'show']);
// route coa
Route::get('coa/tabel', [App\Http\Controllers\CoaController::class,'tabel'])->middleware(['auth']);
Route::get('coa/fetchcoa', [App\Http\Controllers\CoaController::class,'fetchcoa'])->middleware(['auth']);
Route::get('coa/fetchAll', [App\Http\Controllers\CoaController::class,'fetchAll'])->middleware(['auth']);
Route::get('coa/edit/{id}', [App\Http\Controllers\CoaController::class,'edit'])->middleware(['auth']);
Route::get('coa/destroy/{id}', [App\Http\Controllers\CoaController::class,'destroy'])->middleware(['auth']);
Route::resource('coa', CoaController::class)->middleware(['auth']);

// contoh form
Route::get('contohform/fetchAll', [App\Http\Controllers\ContohformController::class,'fetchAll'])->middleware(['auth']);
Route::get('contohform/fetchcontohform', [App\Http\Controllers\ContohformController::class,'fetchcontohform'])->middleware(['auth']);
Route::get('contohform/edit/{id}', [App\Http\Controllers\ContohformController::class,'edit'])->middleware(['auth']);
Route::get('contohform/destroy/{id}', [App\Http\Controllers\ContohformController::class,'destroy'])->middleware(['auth']);
Route::resource('contohform', ContohformController::class)->middleware(['auth']);

// route ke master data perusahaan
Route::resource('/perusahaan', PerusahaanController::class)->middleware(['auth']);
Route::get('/perusahaan/destroy/{id}', [App\Http\Controllers\PerusahaanController::class,'destroy'])->middleware(['auth']);

// route ke master data penelitian
Route::resource('/penelitian', PenelitianController::class)->middleware(['auth']);
Route::get('/penelitian/destroy/{id}', [App\Http\Controllers\PenelitianController::class,'destroy'])->middleware(['auth']);

//route ke master data pengabdian
Route::resource('/pengabdian', PengabdianController::class)->middleware(['auth']);
Route::get('/pengabdian/destroy/{id}', [App\Http\Controllers\PengabdianController::class,'destroy'])->middleware(['auth']);

//route ke master data PIC
Route::resource('/pic', PICController::class)->middleware(['auth']);
Route::get('/pic/destroy/{id}', [App\Http\Controllers\PICController::class,'destroy'])->middleware(['auth']);

//route ke master data Pengeluaran
Route::resource('/pengeluaran', PengeluaranController::class)->middleware(['auth']);
Route::get('/pengeluaran/destroy/{id}', [App\Http\Controllers\PengeluaranController::class,'destroy'])->middleware(['auth']);

//route ke master data Penelitian A
Route::resource('/penelitiana', PenelitianAController::class)->middleware(['auth']);
Route::get('/penelitiana/destroy/{id}', [App\Http\Controllers\PenelitianAController::class,'destroy'])->middleware(['auth']);

// route ke master data jenis kegiatan
Route::resource('/kegiatan', KegiatanController::class)->middleware(['auth']);
Route::get('/kegiatan/destroy/{id}', [App\Http\Controllers\KegiatanController::class,'destroy'])->middleware(['auth']);

Route::resource('/mitra', MitraController::class)->middleware(['auth']);
Route::get('/mitra/destroy/{id}', [App\Http\Controllers\MitraController::class,'destroy'])->middleware(['auth']);

//route ke master data Penelitian B
Route::resource('/penelitianb', PenelitianBController::class)->middleware(['auth']);
Route::get('/penelitianb/destroy/{id}', [App\Http\Controllers\PenelitianBController::class,'destroy'])->middleware(['auth']);

//route ke master data Permintaan
Route::resource('/permintaan', PermintaanController::class)->middleware(['auth']);
Route::get('/permintaan/destroy/{id}', [App\Http\Controllers\PermintaanController::class,'destroy'])->middleware(['auth']);

// route ke master data kas
Route::resource('/kas', KasController::class)->middleware(['auth']);
Route::get('/kas/destroy/{id}', [App\Http\Controllers\KasController::class,'destroy'])->middleware(['auth']);

Route::get('penjualan/barang/{id}', [App\Http\Controllers\PenjualanController::class,'getDataBarang'])->middleware(['auth']);
Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang'])->middleware(['auth']);
Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail'])->middleware(['auth']);
Route::get('penjualan/barang', [App\Http\Controllers\PenjualanController::class,'getDataBarangAll'])->middleware(['auth']);
Route::get('penjualan/jmlbarang', [App\Http\Controllers\PenjualanController::class,'getJumlahBarang'])->middleware(['auth']);
Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson'])->middleware(['auth']);
Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout'])->middleware(['auth']);
Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice'])->middleware(['auth']);
Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice'])->middleware(['auth']);
Route::get('penjualan/status', [App\Http\Controllers\PenjualanController::class,'viewstatus'])->middleware(['auth']);
Route::resource('penjualan', PenjualanController::class)->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang'])->middleware(['auth']);
Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus'])->middleware(['auth']); 
Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus'])->middleware(['auth']);
Route::get('pembayaran/approve/{id}', [App\Http\Controllers\PembayaranController::class,'approve'])->middleware(['auth']);
Route::get('pembayaran/unapprove/{id}', [App\Http\Controllers\PembayaranController::class,'unapprove'])->middleware(['auth']);
Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG'])->middleware(['auth']);
Route::get('pembayaran/edit/{id}', [App\Http\Controllers\PembayaranController::class,'edit'])->middleware(['auth']);
Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/approved/{id}', [PembayaranController::class, 'approved'])->name('approved');
Route::get('/unapproved/{id}', [PembayaranController::class, 'unapproved'])->name('unapproved');
Route::post('/store-harga', [PenjualanController::class, 'store'])->name('storeHarga');


// laporan
Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);

// master jurnal
Route::resource('jurnal', JurnalController::class)->middleware(['auth']);
Route::get('/jurnal/destroy/{id}', [App\Http\Controllers\JurnalController::class,'destroy'])->middleware(['auth']);

require __DIR__.'/auth.php';
