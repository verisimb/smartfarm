<?php

use App\Http\Controllers\LandPredictionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [LandPredictionController::class, 'dashboard'])->name('dashboard');
    Route::resource('predictions', LandPredictionController::class);
});
