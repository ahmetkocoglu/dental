<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::get('test', 'test')->middleware(['guest'])->name('api-test');
    Route::post('login', 'login')->name('api-login');
    Route::post('register', 'register')->name('api-register');
});

Route::controller(DoctorController::class)->prefix('doctor')->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('{id}', 'delete')->name('delete');
});

Route::controller(ClinicController::class)->prefix('clinic')->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('{id}', 'delete')->name('delete');
});

Route::controller(TreatmentController::class)->prefix('treatment')->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('{id}', 'delete')->name('delete');
});

Route::controller(AppointmentController::class)->prefix('appointment')->group(function () {
    Route::get('/', 'index')->name('list');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('{id}', 'delete')->name('delete');
});
