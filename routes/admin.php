<?php

use App\Http\Controllers\Admin\Agencies\AgenciesController;
use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PeopleController\PeopleController;
use App\Http\Controllers\Admin\Settings\AccountController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Vehicles\VehicleController;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'verified'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //routes for the vehicles 
    Route::get('/vehicles-list', [VehicleController::class, 'index'])->name('vehicles');

    //Routes for settings pages 
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    //Account Routes
    Route::get('/settings/account', [SettingsController::class, 'account'])->name('settings.account');
    Route::post('/settings/account', [AccountController::class, 'updateAccount'])->name('settings.account.update');



    Route::get('/settings/email-templates', [SettingsController::class, 'emailTemplates'])->name('settings.email-templates');
    Route::get('/settings/activity-logs', [SettingsController::class, 'activityLogs'])->name('settings.activity-logs');
    Route::get('/settings/roles-permissions', [SettingsController::class, 'rolesPermissions'])->name('settings.roles-permissions');

    //routes for the peopls 
    Route::get('/people/overview', [PeopleController::class, 'overview'])->name('people.overview');
    Route::get('/people/agents', [PeopleController::class, 'agents'])->name('people.agents');
    Route::get('/people/clients', [PeopleController::class, 'clients'])->name('people.clients');

    //Routes for the categories 
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');


    //Routes for the agencies 
    Route::get('/agencies', [AgenciesController::class, 'index'])->name('agencies');
});
