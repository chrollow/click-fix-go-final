<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\DeviceserviceController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
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
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/homepage', [DeviceController::class, 'index'])->name('homepage.index');

Route::prefix('/queue')->group(function () {
    Route::get('/create/{id}', [QueueController::class, 'create'])->name('queue.create');
    Route::post('/store', [QueueController::class, 'store'])->name('queue.store');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('/devices')->group(function () {
    Route::get('/index', [DeviceController::class, 'indexAdmin'])->name('devices.index');
    Route::get('/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/store', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/{id}/update', [DeviceController::class, 'update'])->name('devices.update');
});

Route::prefix('/queues')->group(function () {
    Route::get('/index', [QueueController::class, 'index'])->name('queues.index');
    Route::get('/{id}/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/{id}/tickets/repair', [TicketController::class, 'repair'])->name('tickets.repair');
    Route::get('/{id}/tickets/finish', [TicketController::class, 'finish'])->name('tickets.finish');

    Route::post('/store', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/{id}/update', [DeviceController::class, 'update'])->name('devices.update');
});


Route::prefix('/services')->group(function () {
    Route::get('/{id}', [DeviceserviceController::class, 'index'])->name('smartphones.index');
    Route::get('/create', [SmartphoneController::class, 'create'])->name('smartphones.create');
});




Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', function () {
    return view('logout');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
