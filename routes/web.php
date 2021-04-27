<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TtdController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KadisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\InstalasiController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\SuratSakitController;

Route::get('/', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', function(){
    return redirect('/');
})->name('login');

Route::get('/check/verifikasi/digital/cuti/rsud/{id}', [LoginController::class, 'qrcode']);

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth', 'role:kadis']], function () {
    Route::get('/kadis/home', [KadisController::class, 'home']);
    Route::get('/kadis/profil', [KadisController::class, 'profil']);
    Route::post('/kadis/profil', [KadisController::class, 'changeKadis']);
    Route::get('/kadis/validasi/setujui/{cuti}', [KadisController::class, 'setujui']);
    Route::get('/kadis/validasi/tolak/{cuti}', [KadisController::class, 'tolak']);   
    Route::get('/kadis/download/pdf/{cuti}', [KadisController::class, 'pdf']);   
    Route::get('/kadis/riwayat/cuti', [KadisController::class, 'cuti']);
});
Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('/superadmin/home', [SuperadminController::class, 'home']);
    Route::get('/superadmin/download', [SuperadminController::class, 'download']);
    Route::get('/superadmin/profil', [SuperadminController::class, 'profil']);
    Route::post('/superadmin/profil', [SuperadminController::class, 'changeSuperadmin']);

    Route::get('/superadmin/skpd', [SuperadminController::class, 'skpd']);
    Route::get('/superadmin/skpd/add', [SuperadminController::class, 'addSkpd']);
    Route::post('/superadmin/skpd/add', [SuperadminController::class, 'storeSkpd']);
    Route::get('/superadmin/skpd/edit/{id}', [SuperadminController::class, 'editSkpd']);
    Route::post('/superadmin/skpd/edit/{id}', [SuperadminController::class, 'updateSkpd']);
    Route::get('/superadmin/skpd/delete/{id}', [SuperadminController::class, 'deleteSkpd']);
    
    Route::get('/superadmin/pegawai', [SuperadminController::class, 'pegawai']);
    Route::get('/superadmin/pegawai/add', [SuperadminController::class, 'addPegawai']);
    Route::post('/superadmin/pegawai/add', [SuperadminController::class, 'storePegawai']);
    Route::get('/superadmin/pegawai/edit/{id}', [SuperadminController::class, 'editPegawai']);
    Route::post('/superadmin/pegawai/edit/{id}', [SuperadminController::class, 'updatePegawai']);
    Route::get('/superadmin/pegawai/delete/{id}', [SuperadminController::class, 'deletePegawai']);
    Route::get('/superadmin/pegawai/createuser/{id}', [SuperadminController::class, 'createuser']);
    Route::get('/superadmin/pegawai/createuser', [SuperadminController::class, 'createalluser']);
    Route::get('/superadmin/pegawai/resetpass/{id}', [SuperadminController::class, 'resetpass']);
    Route::get('/superadmin/pegawai/import', [SuperadminController::class, 'import']);
    Route::post('/superadmin/pegawai/import', [SuperadminController::class, 'storeImport']);
    Route::get('/superadmin/pegawai/search', [SuperadminController::class, 'searchPegawai']);
    
    Route::get('/superadmin/setting/kategori/upload', [SuperadminController::class, 'kategori']);
    Route::get('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'addKategori']);
    Route::post('/superadmin/setting/kategori/upload/add', [SuperadminController::class, 'storeKategori']);
    Route::get('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'editKategori']);
    Route::post('/superadmin/setting/kategori/upload/edit/{id}', [SuperadminController::class, 'updateKategori']);
    Route::get('/superadmin/setting/kategori/upload/delete/{id}', [SuperadminController::class, 'deleteKategori']);

    Route::get('/superadmin/manajemen/instalasi', [InstalasiController::class, 'index']);
    Route::get('/superadmin/manajemen/instalasi/kepala', [InstalasiController::class, 'kai']);
    Route::put('/superadmin/manajemen/instalasi/kepala', [InstalasiController::class, 'updateKai']);
    Route::get('/superadmin/manajemen/instalasi/add', [InstalasiController::class, 'create']);
    Route::post('/superadmin/manajemen/instalasi/add', [InstalasiController::class, 'store']);
    Route::get('/superadmin/manajemen/instalasi/edit/{instalasi}', [InstalasiController::class, 'edit']);
    Route::put('/superadmin/manajemen/instalasi/edit/{instalasi}', [InstalasiController::class, 'update']);
    Route::get('/superadmin/manajemen/instalasi/delete/{instalasi}', [InstalasiController::class, 'destroy']);
    Route::get('/superadmin/manajemen/instalasi/{instalasi}/atasan', [InstalasiController::class, 'atasan']);
    Route::post('/superadmin/manajemen/instalasi/{instalasi}/atasan', [InstalasiController::class, 'updateAtasan']);
    
    Route::get('/superadmin/manajemen/instalasi/{instalasi}/ruangan', [RuanganController::class, 'index']);
    Route::get('/superadmin/manajemen/ruangan/kepala', [RuanganController::class, 'karu']);
    Route::put('/superadmin/manajemen/ruangan/kepala', [RuanganController::class, 'updateKaru']);
    Route::get('/superadmin/manajemen/instalasi/{instalasi}/ruangan/add', [RuanganController::class, 'create']);
    Route::post('/superadmin/manajemen/instalasi/{instalasi}/ruangan/add', [RuanganController::class, 'store']);
    Route::get('/superadmin/manajemen/instalasi/{instalasi}/ruangan/edit/{ruangan}', [RuanganController::class, 'edit']);
    Route::put('/superadmin/manajemen/instalasi/{instalasi}/ruangan/edit/{ruangan}', [RuanganController::class, 'update']);
    Route::get('/superadmin/manajemen/instalasi/{instalasi}/ruangan/delete/{ruangan}', [RuanganController::class, 'destroy']);

    Route::get('/superadmin/manajemen/jabatan', [JabatanController::class, 'index']);
    Route::get('/superadmin/manajemen/jabatan/{ruangan}/add', [JabatanController::class, 'create']);
    Route::post('/superadmin/manajemen/jabatan/{ruangan}/add', [JabatanController::class, 'store']);
    Route::get('/superadmin/manajemen/jabatan/edit/{ruangan}/{jabatan}', [JabatanController::class, 'edit']);
    Route::put('/superadmin/manajemen/jabatan/edit/{ruangan}/{jabatan}', [JabatanController::class, 'update']);
    Route::get('/superadmin/manajemen/jabatan/delete/{jabatan}', [JabatanController::class, 'destroy']);
    Route::get('/superadmin/manajemen/jabatan/atasan/{id}', [JabatanController::class, 'atasan']);
    Route::post('/superadmin/manajemen/jabatan/atasan/{id}', [JabatanController::class, 'updateAtasan']);

    Route::get('/superadmin/manajemen/struktural', [ManajemenController::class, 'index']);
    Route::get('/superadmin/manajemen/struktural/add', [ManajemenController::class, 'create']);
    Route::post('/superadmin/manajemen/struktural/add', [ManajemenController::class, 'store']);
    Route::get('/superadmin/manajemen/struktural/edit/{id}', [ManajemenController::class, 'edit']);
    Route::post('/superadmin/manajemen/struktural/edit/{id}', [ManajemenController::class, 'update']);
    Route::get('/superadmin/manajemen/struktural/delete/{id}', [ManajemenController::class, 'delete']);
    Route::get('/superadmin/manajemen/struktural/edit/lihat/{id}', [ManajemenController::class, 'view']);
    Route::get('/superadmin/manajemen/struktural/edit/tidaklihat/{id}', [ManajemenController::class, 'notview']);    
    Route::get('/superadmin/manajemen/struktural/edit/skip/{id}', [ManajemenController::class, 'skip']);
    Route::get('/superadmin/manajemen/struktural/edit/tidakskip/{id}', [ManajemenController::class, 'notskip']);

    Route::get('/superadmin/ttd', [TtdController::class, 'index']);
    Route::get('/superadmin/ttd/upload/{id}', [TtdController::class, 'upload']);
    Route::post('/superadmin/ttd/upload/{id}', [TtdController::class, 'update']);
    
    Route::get('/superadmin/ttd/kadinkes/{id}', [TtdController::class, 'editKadinkes']);
    Route::post('/superadmin/ttd/kadinkes/{id}', [TtdController::class, 'updateKadinkes']);
    Route::get('/superadmin/ttd/kadinkes/{id}/createuser', [TtdController::class, 'createuser']);
    Route::get('/superadmin/ttd/kadinkes/{id}/resetpass', [TtdController::class, 'resetpass']);
    

    Route::get('/superadmin/datacuti', [SuperadminController::class, 'datacuti']);
    Route::get('/superadmin/datacuti/search', [SuperadminController::class, 'datacutisearch']);

});


Route::group(['middleware' => ['auth', 'role:pegawai']], function () {
    Route::get('/pegawai/home', [PegawaiController::class, 'home']);  
    Route::get('/pegawai/profil', [PegawaiController::class, 'profil']);    
    Route::post('/pegawai/profil', [PegawaiController::class, 'changePegawai']);     
    Route::get('/pegawai/profil/edit', [PegawaiController::class, 'editProfil']);    
    Route::put('/pegawai/profil/edit', [PegawaiController::class, 'updateProfil']);    
    Route::get('/pegawai/ajukan/cuti', [CutiController::class, 'ajukan']);   
    Route::post('/pegawai/ajukan/cuti', [CutiController::class, 'store']);  
    Route::get('/pegawai/ajukan/delete/{cuti}', [CutiController::class, 'destroy']);  
    Route::get('/pegawai/ajukan/edit/{cuti}', [CutiController::class, 'edit']);  
    Route::post('/pegawai/ajukan/edit/{cuti}', [CutiController::class, 'update']);  
    Route::get('/pegawai/riwayat/cuti', [PegawaiController::class, 'riwayatCuti']); 

    Route::get('/pegawai/ajukan/validasi/setujui/{cuti}', [CutiController::class, 'setujui']);
    Route::get('/pegawai/ajukan/validasi/setujui/skip/{cuti}', [CutiController::class, 'setujuiskip']);
    Route::get('/pegawai/ajukan/validasi/tolak/{cuti}', [CutiController::class, 'tolak']);   
    Route::get('/pegawai/ajukan/download/pdf/{cuti}', [CutiController::class, 'pdf']);   
    
    Route::get('/pegawai/surat-sakit', [SuratSakitController::class, 'index']);  
    Route::get('/pegawai/surat-sakit/add', [SuratSakitController::class, 'add']);  
    Route::post('/pegawai/surat-sakit/add', [SuratSakitController::class, 'store']);  
    Route::get('/pegawai/surat-sakit/delete/{id}', [SuratSakitController::class, 'delete']);  

});

Route::group(['middleware' => ['auth', 'role:pegawai|superadmin']], function () {
    Route::get('/pegawai/ajukan/download/pdf/{cuti}', [CutiController::class, 'pdf']);   
});
