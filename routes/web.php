<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes (Customer)
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('/full-menu', [LandingPageController::class, 'fullMenu'])->name('full-menu');

// Order Flow (Manual)
Route::get('/order', [CustomerOrderController::class, 'showStartForm'])->name('order.start');
Route::post('/order/start', [CustomerOrderController::class, 'handleStartForm'])->name('order.start.submit');
Route::get('/menu', [CustomerOrderController::class, 'showMenu'])->name('order.menu');

// Order Flow via QR
Route::get('/order/qr/{qrCode}', [CustomerOrderController::class, 'orderByQr'])->name('order.by.qr');
Route::get('/order/qr-form', [CustomerOrderController::class, 'showQrForm'])->name('order.byQr.form');
Route::post('/order/qr-form', [CustomerOrderController::class, 'handleQrForm'])->name('order.byQr.submit');

// Cart Management
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');
Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.get');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Order Placement
Route::post('/order/place/counter', [OrderController::class, 'placeOrderCounter'])->name('order.place.counter');
Route::post('/order/place/online', [OrderController::class, 'placeOrderOnline'])->name('order.place.online');
Route::get('/order/success/{order}', [OrderController::class, 'showSuccess'])->name('order.success');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Tables Management
    Route::resource('tables', TableController::class);

    // QR Code routes for Tables
    Route::get('/tables/{table}/qr', [TableController::class, 'showQrCode'])
        ->name('tables.qr-preview');

    Route::get('/tables/{table}/qr/download', [TableController::class, 'downloadQrCode'])
        ->name('tables.qr-download');

    Route::post('/tables/{table}/qr/regenerate', [TableController::class, 'regenerateQrCode'])
        ->name('tables.regenerateQr');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Users
    Route::resource('users', UserManagementController::class);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Karyawan Routes (POS System)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:karyawan'])
    ->prefix('pos')
    ->name('pos.')
    ->group(function () {

    Route::get('/', [PosController::class, 'index'])->name('index');
    Route::post('/order/{order}/status', [PosController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/board-data', [PosController::class, 'fetchKanbanData'])->name('boardData');

    // Route untuk cetak struk
    Route::get('/receipt/{order}', [\App\Http\Controllers\ReceiptController::class, 'show'])->name('receipt.show');
});
