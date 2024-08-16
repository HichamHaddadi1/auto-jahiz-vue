<?php

use App\Http\Controllers\Admin\Settings\AccountController;
use App\Http\Controllers\Admin\Vehicles\VehiclesApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/fetch-vehicles', [VehiclesApiController::class, 'fetchVehicles'])->name('fetch-vehicles');





    //Referentiel Routes
    Route::get('/fetch-currencies', [AccountController::class, 'fetchCurrencies'])->name('fetch-currencies');
    Route::get('/fetch-languages', [AccountController::class, 'fetchLanguages'])->name('fetch-languages');
});
