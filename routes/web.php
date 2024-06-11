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
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PICController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\Auth\RegisterController;

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

// untuk berita
Route::get('berita', [App\Http\Controllers\BeritaController::class,'index'])->middleware(['auth']);
Route::get('berita/galeri', [App\Http\Controllers\BeritaController::class,'getNews'])->middleware(['auth']);
Route::get('berita/coba3', [App\Http\Controllers\BeritaController::class,'coba3'])->middleware(['auth']);

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    // master jurnal
    Route::resource('jurnal', JurnalController::class)->middleware(['auth']);
    Route::get('/jurnal/destroy/{id}', [App\Http\Controllers\JurnalController::class,'destroy'])->middleware(['auth']);

    // laporan
    Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
    Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
    Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
    Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);

    Route::get('/pemasukan/tambah', function () {
        return view('pemasukan.tambah');
    });
    
    route::get('/pemasukan', function (){
        return view('pemasukan/create');
    });
    
    route::get('/pemasukan/edit/{id}', function (){
        return view('pemasukan/edit');
    });
    
    
    Route::get('/pengeluaran/tambah', function () {
        return view('pengeluaran.tambah');
    });

    Route::resource('/jurnal', JurnalController::class)->middleware(['auth']);

    Route::resource('/pemasukan', PemasukanController::class)->middleware(['auth']);
    Route::get('/pemasukan/tambah', [PemasukanController::class, 'create'])->name('pemasukan.tambah');
    Route::get('/pemasukan/destroy/{id}', [App\Http\Controllers\PemasukanController::class,'destroy'])->middleware(['auth']);

    Route::resource('/pengeluaran', PengeluaranController::class)->middleware(['auth']);
    Route::get('/pengeluaran/destroy/{id}', [App\Http\Controllers\PengeluaranController::class,'destroy'])->middleware(['auth']);

    Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG'])->middleware(['auth']);
    Route::resource('pembayaran', PembayaranController::class)->middleware(['auth']);

    // untuk midtrans
    Route::get('midtrans', [App\Http\Controllers\CobaMidtransController::class,'index'])->middleware(['auth']);
    Route::get('midtrans/status', [App\Http\Controllers\CobaMidtransController::class,'cekstatus2'])->middleware(['auth']);
    Route::get('midtrans/status2/{id}', [App\Http\Controllers\CobaMidtransController::class,'cekstatus'])->middleware(['auth']);
    Route::get('midtrans/bayar', [App\Http\Controllers\CobaMidtransController::class,'bayar'])->middleware(['auth']);
    Route::post('midtrans/proses_bayar', [App\Http\Controllers\CobaMidtransController::class,'proses_bayar'])->middleware(['auth']);
});




Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');


require __DIR__.'/auth.php';
