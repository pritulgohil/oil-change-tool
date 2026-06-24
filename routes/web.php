<?php

use App\Http\Controllers\OilChangeCheckController;
use Illuminate\Support\Facades\Route;

Route::controller(OilChangeCheckController::class)->group(function (): void {
    Route::get('/', 'create')->name('oil-change.create');
    Route::post('/check', 'store')->name('oil-change.store');
    Route::get('/result/{oilChangeCheck}', 'show')->whereUlid('oilChangeCheck')->name('oil-change.show');
});
