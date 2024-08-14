<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Livewire\Form;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Form::class);
Route::get('/completed', [Form::class, 'completed']);

Route::get('download', [PDFController::class, 'downloadPdf'])->name('download.tes');
Route::get('download/{id}', [PDFController::class, 'userPdf'])->name('download.pdf');

Route::get('downloadcover/{post}', [DownloadController::class, 'download'])->name('download.cover');

