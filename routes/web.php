<?php

use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('download', [PDFController::class, 'downloadPdf'])->name('download.tes');
Route::get('download/{id}', [PDFController::class, 'userPdf'])->name('download.pdf');

Route::get('downloadcover/{post}', [DownloadController::class, 'download'])->name('download.cover');

