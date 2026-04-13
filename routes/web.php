<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AiController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return view('landing');
});

Route::post('/ai/process', [AiController::class, 'process'])->name('ai.process');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/pdf/generate', [PdfController::class, 'generate'])->name('pdf.generate')->middleware('auth');
