<?php

use App\Models\Technician;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SmartphoneController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\DeviceserviceController;
use App\Http\Controllers\TechnicianQueueController;

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

Route::prefix('/technicians')->group(function () {
    Route::get('/index', [TechnicianController::class, 'index'])->name('technicians.index');
    Route::get('/register', [TechnicianController::class, 'register'])->name('technicians.register');
    Route::POST('/register/store', [TechnicianController::class, 'registerStore'])->name('technicians.registerStore');
    Route::get('/create', [TechnicianController::class, 'create'])->name('technicians.create');
    Route::post('/store', [TechnicianController::class, 'store'])->name('technicians.store');
    Route::get('/{id}/edit', [TechnicianController::class, 'edit'])->name('technicians.edit');
    Route::put('/update', [TechnicianController::class, 'update'])->name('technicians.update');
    Route::delete('/destroy', [TechnicianController::class, 'destroy'])->name('technicians.destroy');
});

Route::middleware(['admin_or_technician'])->group(function () {
    // Define routes accessible by admin or technician users here
    Route::prefix('/technicians/queues')->group(function () {
        Route::get('/index', [TechnicianQueueController::class, 'index'])->name('techniciansqueue.index');
        Route::get('/{id}/edit', [TechnicianQueueController::class, 'edit'])->name('techniciansqueue.edit');
        Route::get('/{id}/finish', [TechnicianQueueController::class, 'finish'])->name('techniciansqueue.finish');
        Route::post('/tickets/finish', [TicketController::class, 'finish'])->name('tickets.finish');
    });
    // Add more routes as needed
});



// Route::group(['middleware' => 'admin'], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// });
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
});

Route::prefix('/devices')->group(function () {
    Route::get('/index', [DeviceController::class, 'indexAdmin'])->name('devices.index');
    Route::get('/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/store', [DeviceController::class, 'store'])->name('devices.store');
    Route::get('/{id}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/{id}/update', [DeviceController::class, 'update'])->name('devices.update');
    Route::delete('/{device}/destroy', [DeviceController::class, 'destroy'])->name('devices.destroy');
});

Route::prefix('/queues')->group(function () {
    Route::get('/index', [QueueController::class, 'index'])->name('queues.index');
    Route::get('/{id}/finish', [QueueController::class, 'finish'])->name('queues.finish');
    Route::get('/{id}/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/{id}/tickets/repair', [TicketController::class, 'repair'])->name('tickets.repair');
});

Route::prefix('/queues/customer')->group(function () {
    Route::get('/index', [QueueController::class, 'queueIndex'])->name('Queues');
    Route::post('/destroy', [QueueController::class, 'queueDestroy'])->name('queues.destroy');
});

Route::prefix('/stock-suppliers')->group(function () {
    Route::get('', [StockSupplierController::class, 'index'])->name('stock-suppliers.index');
    Route::get('/create', [StockSupplierController::class, 'create'])->name('stock-suppliers.create');
    Route::post('/', [StockSupplierController::class, 'store'])->name('stock-suppliers.store');
    Route::put('/{stock_supplier}/edit', [StockSupplierController::class, 'edit'])->name('stock-suppliers.edit');
    Route::put('/{stock_supplier}', [StockSupplierController::class, 'update'])->name('stock-suppliers.update');
    Route::delete('/{stock_supplier}', [StockSupplierController::class, 'destroy'])->name('stock-suppliers.destroy');
});

Route::prefix('/supplier')->group(function () {
    Route::get('', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('suppliers.create');
    Route::post('/store', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::put('/{supplier}/update', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
});

Route::prefix('/services')->group(function () {
    Route::get('/{id}', [DeviceserviceController::class, 'index'])->name('deviceservices.index');
    Route::get('/create', [SmartphoneController::class, 'create'])->name('services.create');
});

Route::get('/services/index', [ServiceController::class, 'index'])->name('services.index');

Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', function () {
    return view('logout');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');