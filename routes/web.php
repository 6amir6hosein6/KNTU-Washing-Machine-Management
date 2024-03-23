<?php

use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\WashingMachineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['web', 'guest:student'])->group(function () {
    Route::get('/', [authController::class, 'index'])->name('student-login.form');
    Route::post('/login', [authController::class, 'login'])->name('student-login.action');
});
Route::middleware(['web', 'auth:student'])->group(function () {
    Route::get('/logout', [authController::class, 'logout'])->name('student-logout.action');
    Route::get('/test', [authController::class, 'test'])->name('test');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('student-dashboard');

    Route::get('/washing-machine-reserve', [WashingMachineController::class, 'reserveForm'])
        ->name('student-washing-machine-reserve.form');
    Route::post('/washing-machine-reserve', [WashingMachineController::class, 'reserveAction'])
        ->name('student-washing-machine-reserve.action');

    Route::post('/washing-machine-reserve-get-time', [WashingMachineController::class, 'getTimes'])
        ->name('student-washing-machine-reserve-get-time');
});

Route::get('/test',function (){
    dd(\App\Helper\ReserveHelper::getTimeSlots("2024-01-12","QT-#DFDf"));
});
