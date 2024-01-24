<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\VipController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('masuk');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'LoginAuth:admin'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/buatsurat', [PagesController::class, 'buatsurat'])->name('buatsurat');
    Route::get('/profil', [PagesController::class, 'profil'])->name('profil');
    Route::get('/search', [PagesController::class, 'search'])->name('search');
    Route::get('/history', [SuratController::class, 'index'])->name('history');
    Route::get('/filter', [SuratController::class, 'filter'])->name('filter');
    Route::get('/suratexport', [SuratController::class, 'export'])->name('export');
    Route::get('/suratindividu', [PagesController::class, 'suratindividu'])->name('suratindividu');
    Route::get('/suratkolektif', [PagesController::class, 'suratkolektif'])->name('suratkolektif');
    Route::get('/suratduplikatindividu', [PagesController::class, 'suratduplikatindividu'])->name('suratduplikatindividu');
    Route::get('/suratduplikatkolektif', [PagesController::class, 'suratduplikatkolektif'])->name('suratduplikatkolektif');
    Route::post('/individu-pdf', [PdfController::class, 'IndividuPdf'])->name('individu-pdf');
    Route::post('/kolektif-pdf', [PdfController::class, 'KolektifPdf'])->name('kolektif-pdf');
    Route::post('/duplikat-pdf-individu', [PdfController::class, 'DuplicatePdfIndividu'])->name('duplikat-pdf-individu');
    Route::post('/duplikat-pdf-kolektif', [PdfController::class, 'DuplicatePdfKolektif'])->name('duplikat-pdf-kolektif');
    Route::get('/download/{id}', [PdfController::class, 'download'])->name('download');
    Route::get('/index', [PegawaiController::class, 'index'])->name('draft.index');
    Route::get('/create', [PegawaiController::class, 'create'])->name('draft.create');
    Route::post('/create', [PegawaiController::class, 'store'])->name('store');
    Route::get('/store/{edits}/edit', [PegawaiController::class, 'edit'])->name('draft.edit');
    Route::put('/store/{edits}/update', [PegawaiController::class, 'update'])->name('Update');
    Route::delete('/store/{edits}/destroy', [PegawaiController::class, 'destroy'])->name('Destroy');
    Route::get('/indexvip', [VipController::class, 'index'])->name('draftvip.indexvip');
    Route::get('/createvip', [VipController::class, 'create'])->name('draftvip.createvip');
    Route::post('/createvip', [VipController::class, 'store'])->name('storevip');
    Route::get('vip/store/{edits}/edit', [VipController::class, 'edit'])->name('draftvip.editvip');
    Route::put('vip/store/{edits}/update', [VipController::class, 'update'])->name('Updatevip');
    Route::delete('vip/store/{edits}/destroy', [VipController::class, 'destroy'])->name('Destroyvip');
});

Route::middleware(['auth', 'LoginAuth:admin,user'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/buatsurat', [PagesController::class, 'buatsurat'])->name('buatsurat');
    Route::get('/profil', [PagesController::class, 'profil'])->name('profil');
    Route::get('/filter', [SuratController::class, 'filter'])->name('filter');
    Route::get('/suratindividu', [PagesController::class, 'suratindividu'])->name('suratindividu');
    Route::get('/suratkolektif', [PagesController::class, 'suratkolektif'])->name('suratkolektif');
    Route::get('/suratduplikatindividu', [PagesController::class, 'suratduplikatindividu'])->name('suratduplikatindividu');
    Route::get('/suratduplikatkolektif', [PagesController::class, 'suratduplikatkolektif'])->name('suratduplikatkolektif');
    Route::post('/individu-pdf', [PdfController::class, 'IndividuPdf'])->name('individu-pdf');
    Route::post('/kolektif-pdf', [PdfController::class, 'KolektifPdf'])->name('kolektif-pdf');
    Route::post('/duplikat-pdf-individu', [PdfController::class, 'DuplicatePdfIndividu'])->name('duplikat-pdf-individu');
    Route::post('/duplikat-pdf-kolektif', [PdfController::class, 'DuplicatePdfKolektif'])->name('duplikat-pdf-kolektif');
});
