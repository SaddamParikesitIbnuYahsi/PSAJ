<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES - SISTEM MANAJEMEN UMROH (LENGKAP & NO JSON)
|--------------------------------------------------------------------------
*/

// REDIRECT BERDASARKAN ROLE SAAT LOGIN
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return redirect(match ($user->role) {
            'Admin'             => route('admin.dashboard'),
            'Staf Registrasi'   => route('staff.dashboard'),
            'User'              => route('manajergudang.dashboard'), 
            default             => '/login',
        });
    }
    return view('layouts.welcome');
})->name('welcome');

// GUEST ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/register', fn() => view('auth.register'))->name('register');
});

// AUTH ACTIONS
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
});

// ===================================
// 1. ADMIN ROUTES (Prefix: admin)
// ===================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // --- USER MANAGEMENT ---
    Route::get('/users', [AdminDashboardController::class, 'userList'])->name('users.index');
    Route::get('/users/create', [AdminDashboardController::class, 'userCreate'])->name('users.create');
    Route::post('/users', [AdminDashboardController::class, 'userStore'])->name('users.store');
    Route::get('/users/{user}', [AdminDashboardController::class, 'userShow'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'userEdit'])->name('users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'userUpdate'])->name('users.update');
    Route::get('/users/{user}/delete', [AdminDashboardController::class, 'confirmDeleteUser'])->name('users.delete');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'userDestroy'])->name('users.destroy');

    // --- MANIFEST JAMAAH (PRODUCTS) ---
    Route::get('/products', [AdminDashboardController::class, 'productList'])->name('products.index');
    Route::get('/products/create', [AdminDashboardController::class, 'productCreate'])->name('products.create');
    Route::post('/products', [AdminDashboardController::class, 'productStore'])->name('products.store');
    Route::get('/products/{product}', [AdminDashboardController::class, 'productShow'])->name('products.show');
    Route::get('/products/{product}/edit', [AdminDashboardController::class, 'productEdit'])->name('products.edit');
    Route::put('/products/{product}', [AdminDashboardController::class, 'productUpdate'])->name('products.update');
    Route::get('/products/{product}/delete', [AdminDashboardController::class, 'confirmDeleteProduct'])->name('products.confirm-delete');
    Route::delete('/products/{product}', [AdminDashboardController::class, 'destroy'])->name('products.destroy');

    // --- PROGRAM PAKET (CATEGORIES) ---
    Route::get('/categories', [AdminDashboardController::class, 'categoryList'])->name('categories.index');
    Route::get('/categories/create', [AdminDashboardController::class, 'categoryCreate'])->name('categories.create');
    Route::post('/categories', [AdminDashboardController::class, 'categoryStore'])->name('categories.store');
    Route::get('/categories/{category}', [AdminDashboardController::class, 'categoryShow'])->name('categories.show');
    Route::get('/categories/{category}/edit', [AdminDashboardController::class, 'categoryEdit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminDashboardController::class, 'categoryUpdate'])->name('categories.update');
    Route::get('/categories/{category}/delete', [AdminDashboardController::class, 'confirmDeleteCategory'])->name('categories.delete');
    Route::delete('/categories/{category}', [AdminDashboardController::class, 'categoryDestroy'])->name('categories.destroy');

    // --- AGEN & MITRA (SUPPLIERS) ---
    Route::get('/suppliers', [AdminDashboardController::class, 'supplierList'])->name('suppliers.index');
    Route::get('/suppliers/create', [AdminDashboardController::class, 'supplierCreate'])->name('suppliers.create');
    Route::post('/suppliers', [AdminDashboardController::class, 'supplierStore'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [AdminDashboardController::class, 'supplierShow'])->name('suppliers.show');
    Route::get('/suppliers/{supplier}/edit', [AdminDashboardController::class, 'supplierEdit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [AdminDashboardController::class, 'supplierUpdate'])->name('suppliers.update');
    Route::get('/suppliers/{supplier}/delete', [AdminDashboardController::class, 'confirmDeleteSupplier'])->name('suppliers.delete');
    Route::delete('/suppliers/{supplier}', [AdminDashboardController::class, 'supplierDestroy'])->name('suppliers.destroy');

    // --- TOOLS, EXPORT, REPORTS ---
    Route::get('export', [AdminDashboardController::class, 'export'])->name('products.export');
    Route::get('export-template', [AdminDashboardController::class, 'exportTemplate'])->name('products.export-template');
    Route::post('import', [AdminDashboardController::class, 'import'])->name('products.import');
    
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/stock', [AdminDashboardController::class, 'reportStock'])->name('stock');
        Route::get('/transactions', [AdminDashboardController::class, 'reportTransactions'])->name('transactions');
    });

    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

// ===================================
// 2. STAF REGISTRASI ROUTES
// ===================================
Route::middleware(['auth', 'role:Staf Registrasi'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
    Route::prefix('stock')->name('stock.')->group(function () {
        Route::prefix('incoming')->name('incoming.')->group(function () {
            Route::get('/', [StaffTaskController::class, 'listIncoming'])->name('list');
            Route::get('/{transaction}/confirm', [StaffTaskController::class, 'showIncomingConfirmationForm'])->name('confirm');
            Route::post('/{transaction}/complete', [StaffTaskController::class, 'processIncomingConfirmation'])->name('complete');
        });
        Route::prefix('outgoing')->name('outgoing.')->group(function () {
            Route::get('/', [StaffTaskController::class, 'listOutgoing'])->name('list');
            Route::get('/{transaction}/prepare', [StaffTaskController::class, 'showOutgoingPreparationForm'])->name('prepare');
            Route::post('/{transaction}/dispatch', [StaffTaskController::class, 'processOutgoingDispatch'])->name('dispatch');
        });
    });
    Route::get('/reports/incoming', [StaffReportController::class, 'showIncomingReport'])->name('reports.incoming');
    Route::get('/reports/outgoing', [StaffReportController::class, 'showOutgoingReport'])->name('reports.outgoing');
    Route::get('/profile', [StaffDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [StaffDashboardController::class, 'updateProfile'])->name('profile.update');
});

// ===================================
// 3. USER (JAMAAH) ROUTES
// ===================================
Route::middleware(['auth', 'role:User'])->prefix('user')->name('manajergudang.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/stock/in', [ManagerDashboardController::class, 'stockIn'])->name('stock.in');
    Route::post('/stock/in', [ManagerDashboardController::class, 'stockInStore'])->name('stock.in.store');
    Route::get('/stock/history', [ManagerDashboardController::class, 'stockHistory'])->name('stock.history');
    Route::get('/products', [ManagerDashboardController::class, 'productList'])->name('products.index');
    Route::get('/products/{product}', [ManagerDashboardController::class, 'productShow'])->name('products.show');
    Route::get('/profile', [ManagerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [ManagerDashboardController::class, 'updateProfile'])->name('profile.update');
});

// SKU Generator API
Route::post('/admin/products/generate-sku', [AdminDashboardController::class, 'generateSkuApi'])->name('admin.products.generate-sku');

Route::fallback(fn() => redirect('/login'));