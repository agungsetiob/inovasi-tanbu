<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SkpdController, 
    ContactController,
    FileController,
    BackupController,
    VisitorController,
    CategoryController,
    IndikatorController,
    BuktiController,
    KlasifikasiController,
    TematikController,
    TahapanController,
    CarouselController,
    SettingController,
    BackgroundController
};
use App\Http\Controllers\BentukController;
use App\Http\Controllers\InisiatorController;
use App\Http\Controllers\UrusanController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', [VisitorController::class, 'index']);
Route::get('/inovasi', [VisitorController::class, 'inovasi']);
Route::get('/litbang', [VisitorController::class, 'litbang']);
Route::get('/riset', [VisitorController::class, 'riset']);
Route::get('show/inovasi/{proposal}', [VisitorController::class, 'show']);
Route::get('inovasi/all', [VisitorController::class, 'proposal']);

Route::post('/send/message/', [ContactController::class, 'store']);

Route::get('print/report/{id}', [ProposalController::class, 'proposalReport']);

Route::middleware(['auth'])->group(function () {

    Route::resource('proyek/inovasi', ProposalController::class);
    Route::get('data/inovasi', [ProposalController::class, 'database'])->name('database');
    Route::put('send/inovasi/{inovasi}', [ProposalController::class, 'sendProposal']);
    Route::get('api/inovasi', [ProposalController::class, 'loadProposals']);
    Route::get('api/database/inovasi', [ProposalController::class, 'sentProposals']);

    Route::resource('/admin', \App\Http\Controllers\AdminController::class);
    Route::get('/user', [\App\Http\Controllers\AdminController::class, 'user'])->name('user.index');

    Route::resource('master/inisiator', InisiatorController::class);
    Route::put('inisiator/change-status/{id}', [InisiatorController::class, 'changeStatus']);

    Route::resource('master/tahapan', TahapanController::class);
    Route::put('tahapan/change-status/{id}', [TahapanController::class, 'changeStatus']);

    Route::resource('master/jenis', CategoryController::class);
    Route::put('jenis/change-status/{id}', [CategoryController::class, 'changeStatus']);

    Route::resource('master/bentuk', BentukController::class);
    Route::post('bentuk/change-status/{id}', [BentukController::class, 'changeStatus']);

    Route::resource('master/skpd', SkpdController::class);
    Route::put('skpd/change-status/{id}', [SkpdController::class, 'changeStatus']);
    Route::get('api/skpd', [SkpdController::class, 'loadSkpds']);

    Route::resource('master/urusan', UrusanController::class);
    Route::post('/toggle-status/urusan/{urusan}', [UrusanController::Class, 'toggleStatus']);
    Route::get('master/klasifikasi/detail', [UrusanController::Class, 'klasifikasi']);

    Route::resource('master/indikator', IndikatorController::class);
    Route::get('api/indikator', [IndikatorController::class, 'loadIndikators']);
    Route::put('indikator/change-status/{id}', [IndikatorController::class, 'changeStatus']);

    Route::resource('master/bukti', BuktiController::class);
    Route::post('bukti/change-status/{id}', [BuktiController::class, 'changeStatus']);
    Route::get('api/bukti', [BuktiController::class, 'loadBuktis']);

    Route::resource('master/klasifikasi', KlasifikasiController::class);
    Route::post('/toggle-status/klasifikasi/{klasifikasi}', [KlasifikasiController::Class, 'toggleStatus']);

    Route::resource('master/tematik', TematikController::class);
    Route::post('/toggle-status/tematik/{tematik}', [TematikController::Class, 'toggleStatus']);
    Route::get('api/tematik', [TematikController::Class, 'loadTematiks']);

    Route::get('bukti-dukung/{id}', [FileController::class, 'index']);
    Route::post('upload/file', [FileController::class, 'store']);
    Route::post('upload/spd', [FileController::class, 'storeSpd']);
    Route::put('spd/edit/{file}', [FileController::class, 'updateSpd']);
    Route::put('bukti-dukung/edit/{file}', [FileController::class, 'update']);
    Route::get('bukti-dukung/add/{indikator}', [FileController::class, 'show']);
    Route::get('bukti-dukung/data/{proposal}/{indikator}', [FileController::class, 'edit']);
    Route::get('bukti/inovasi/{id}', [FileController::class, 'bukti']);
    
    Route::get('/backup', [BackupController::class, 'index']);
    Route::get('/backup/only-db', [BackupController::class, 'create']);
    Route::get('/backup/delete/{file_name}', [BackupController::class, 'delete']);

    Route::get('messages', [ContactController::class, 'index']);
    Route::delete('delete/message/{id}', [ContactController::class, 'destroy']);
    Route::get('messages/laporan/{startdate}/{enddate}', [ContactController::class, 'messagesReport']);

    Route::get('data/profile/', [ProfileController::class, 'index']);
    Route::get('indikator/spd/{profile}', [ProfileController::class, 'show']);
    Route::post('profile/create', [ProfileController::class, 'store']);
    Route::put('profile/update/{profile}', [ProfileController::class, 'update']);
    Route::get('edit/profile/{profile}', [ProfileController::class, 'edit']);

    Route::get('carousel', [CarouselController::class, 'index']);
    Route::post('carousel/upload', [CarouselController::class, 'store']);
    Route::delete('carousel/{carousel}', [CarouselController::class, 'destroy']);

    Route::get('system/setting', [SettingController::class, 'index']);
    Route::post('setting/create', [SettingController::class, 'store']);
    Route::get('setting/show/{setting}', [SettingController::class, 'show']);
    Route::put('setting/update/{setting}', [SettingController::class, 'update']);

    Route::resource('background', BackgroundController::class);


});


require __DIR__.'/auth.php';
