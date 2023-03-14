<?php

use App\Models\Proposals;
use App\Http\Livewire\SkimTable;
use App\Http\Livewire\UserTable;
use App\Http\Livewire\DosenTable;
use App\Http\Livewire\ProdiTable;
use App\Http\Livewire\BidangTable;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\ListProposal;
use App\Http\Livewire\FakultasTable;
use App\Http\Livewire\PublikasiTable;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateProposal;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\LaporanHasilTable;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\LapHasilController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SeminarHasilController;
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

// Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('loginredirect');
// Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
// Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// })->name('loginui');

Route::get('/', [PageController::class, 'index'])->name('home');


Route::get('/loginredirect', [AuthController::class, 'login'])->name('loginredirect');
Route::get('/login', function(){
    return view('loginui');
})->name('loginui');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');

// Route::get('/admin', [DashboardController::class, 'index'])->name('admin');


// Route::get('/admin/proposal/create', [CreateProposal::class, 'index'])->name('admin.proposal.create');


// Route::get('/admin/users', UserTable::class)->name('admin.users');
// Route::get('/admin/bidangs', BidangTable::class)->name('admin.bidangs');
// Route::get('/admin/skims', SkimTable::class)->name('admin.skims');
// Route::get('/admin/fakultas', FakultasTable::class)->name('admin.fakultas');
// Route::get('/admin/prodis', ProdiTable::class)->name('admin.prodis');
// Route::get('/admin/proposals', ListProposal::class)->name('admin.proposals');
// Route::get('/admin/dosens', DosenTable::class)->name('admin.dosens');
// Route::get('/admin/proposals/seminar', [SemproController::class, 'index'])->name('admin.proposals.seminar');



Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['ceklogin:admin']], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
        Route::get('/admin/bidangs', BidangTable::class)->name('admin.bidangs');
        Route::get('/admin/skims', SkimTable::class)->name('admin.skims');
        Route::get('/admin/fakultas', FakultasTable::class)->name('admin.fakultas');
        Route::get('/admin/prodis', ProdiTable::class)->name('admin.prodis');
        Route::get('/admin/proposals', ListProposal::class)->name('admin.proposals');
        Route::get('/admin/dosens', DosenTable::class)->name('admin.dosens');
        Route::get('/admin/proposals/seminar', [SemproController::class, 'index'])->name('admin.proposals.seminar');
        Route::get('admin/proposals/{id}', [ProposalController::class,'show'])->name('proposal.detail');
        Route::get('/admin/laporan-hasil',LaporanHasilTable::class)->name('admin.laporan-hasil');
        Route::get('/admin/laphasil/{id}', [LapHasilController::class,'show'])->name('admin.laphasil.detail');
        Route::get('/admin/laporan-hasil/seminar', [SeminarHasilController::class, 'index'])->name('admin.laporan-hasil.seminar');
        Route::get('/admin/publikasi', PublikasiTable::class)->name('admin.publikasi');
    });
    Route::group(['middleware' => ['ceklogin:sp-admin']], function () {
        Route::get('/sp-admin/users', UserTable::class)->name('sp-admin.users');
        Route::get('/sp-admin', [DashboardController::class, 'index'])->name('sp-admin');
        Route::get('/sp-admin/bidangs', BidangTable::class)->name('sp-admin.bidangs');
        Route::get('/sp-admin/skims', SkimTable::class)->name('sp-admin.skims');
        Route::get('/sp-admin/fakultas', FakultasTable::class)->name('sp-admin.fakultas');
        Route::get('/sp-admin/prodis', ProdiTable::class)->name('sp-admin.prodis');
        Route::get('/sp-admin/proposals', ListProposal::class)->name('sp-admin.proposals');
        Route::get('/sp-admin/dosens', DosenTable::class)->name('sp-admin.dosens');
        Route::get('/sp-admin/proposals/seminar', [SemproController::class, 'index'])->name('sp-admin.proposals.seminar');
        Route::get('/sp-admin/laporan-hasil/seminar', [SeminarHasilController::class, 'index'])->name('sp-admin.laporan-hasil.seminar');
        Route::get('sp-admin/proposals/{id}', [ProposalController::class,'show'])->name('sp-admin.proposal.detail');
        Route::get('sp-admin/laphasil/{id}', [LapHasilController::class,'show'])->name('sp-admin.laphasil.detail');
        Route::get('/sp-admin/laporan-hasil',LaporanHasilTable::class)->name('sp-admin.laporan-hasil');
        Route::get('/sp-admin/publikasi', PublikasiTable::class)->name('sp-admin.publikasi');
    });
});

