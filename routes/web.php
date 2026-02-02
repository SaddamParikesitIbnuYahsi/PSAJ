<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StaffTaskController;
use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\ManagerDashboardController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES - SISTEM MANAJEMEN UMROH (PAS VERSION)
|--------------------------------------------------------------------------
*/

// ===================================
// HALAMAN UTAMA & REDIRECT DASHBOARD
// ===================================
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return redirect(match ($user->role) {
            'Admin'               => route('admin.dashboard'),
            'Manajer Operasional' => route('manajergudang.dashboard'),
            'Staf Registrasi'     => route('staff.dashboard'),
            default               => '/login',
        });
    }
    return view('layouts.welcome');
})->name('welcome');

// GUEST ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/register', fn() => view('auth.register'))->name('register');
});

// PROSES AUTH
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/login/simple', [AuthController::class, 'simpleLogin'])->name('login.simple');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('auth.me');
});

// ===================================
// 1. ADMIN ROUTES
// ===================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->except(['destroy']);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);

    // User Management
    Route::get('/users', [AdminDashboardController::class, 'userList'])->name('users.index');
    Route::get('/users/create', [AdminDashboardController::class, 'userCreate'])->name('users.create');
    Route::post('/users', [AdminDashboardController::class, 'userStore'])->name('users.store');
    Route::get('/users/{user}', [AdminDashboardController::class, 'userShow'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'userEdit'])->name('users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'userUpdate'])->name('users.update');
    Route::get('/users/{user}/delete', [AdminDashboardController::class, 'confirmDeleteUser'])->name('users.delete');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'userDestroy'])->name('users.destroy');

    // Products list & tools
    Route::get('/products-list', [AdminDashboardController::class, 'productList'])->name('products.index');
    Route::get('export', [AdminDashboardController::class, 'export'])->name('products.export');
    Route::get('export-template', [AdminDashboardController::class, 'exportTemplate'])->name('products.export-template');
    Route::post('import', [AdminDashboardController::class, 'import'])->name('products.import');

    // Admin Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('/transactions', [ReportController::class, 'transactions'])->name('transactions');
        Route::get('/users', [ReportController::class, 'users'])->name('users');
        Route::get('/system', [ReportController::class, 'system'])->name('system');
    });

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminDashboardController::class, 'updateProfile'])->name('profile.update');
});

// ===================================
// 2. MANAJER OPERASIONAL ROUTES
// ===================================
Route::middleware(['auth', 'role:Manajer Operasional'])->prefix('manajer')->name('manajergudang.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
    
    // Produk & Jamaah
    Route::get('/products', [ManagerDashboardController::class, 'productList'])->name('products.index');
    Route::get('/products/{product}', [ManagerDashboardController::class, 'productShow'])->name('products.show');
    
    // Stok & Inventori
    Route::get('/stock', [ManagerDashboardController::class, 'stockIndex'])->name('stock.index');
    Route::get('/stock/in', [ManagerDashboardController::class, 'stockIn'])->name('stock.in');
    Route::post('/stock/in', [ManagerDashboardController::class, 'stockInStore'])->name('stock.in.store');
    Route::get('/stock/out', [ManagerDashboardController::class, 'stockOut'])->name('stock.out');
    Route::post('/stock/out', [ManagerDashboardController::class, 'stockOutStore'])->name('stock.out.store');
    Route::get('/stock/opname', [ManagerDashboardController::class, 'stockOpname'])->name('stock.opname');
    Route::get('/stock/history', [ManagerDashboardController::class, 'stockHistory'])->name('stock.history');

    // Supplier & Agen
    Route::get('/suppliers', [ManagerDashboardController::class, 'supplierList'])->name('suppliers.index');
    Route::get('/suppliers/{supplier}', [ManagerDashboardController::class, 'supplierShow'])->name('suppliers.show');

    // Transaksi
    Route::get('/transactions', [ManagerDashboardController::class, 'transactionList'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [ManagerDashboardController::class, 'transactionShow'])->name('transactions.show');
    Route::put('/transactions/{transaction}/approve', [ManagerDashboardController::class, 'transactionApprove'])->name('transactions.approve');
    Route::put('/transactions/{transaction}/reject', [ManagerDashboardController::class, 'transactionReject'])->name('transactions.reject');

    // Manager Reports (INI YANG TADI ERROR)
    Route::get('/reports', [ManagerDashboardController::class, 'reportIndex'])->name('reports.index');
    Route::get('/reports/stock', [ManagerDashboardController::class, 'reportStock'])->name('reports.stock');
    Route::get('/reports/transactions', [ManagerDashboardController::class, 'reportTransactions'])->name('reports.transactions');
    Route::get('/reports/inventory', [ManagerDashboardController::class, 'reportInventory'])->name('reports.inventory');

    // Staf & Profile
    Route::get('/staff', [ManagerDashboardController::class, 'staffList'])->name('staff.index');
    Route::get('/profile', [ManagerDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [ManagerDashboardController::class, 'updateProfile'])->name('profile.update');
});

// ===================================
// 3. STAF REGISTRASI ROUTES
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

// SKU Generator API
Route::post('/admin/products/generate-sku', [AdminDashboardController::class, 'generateSkuApi'])->name('admin.products.generate-sku');

// ===================================
// FALLBACK
// ===================================
Route::fallback(function () {
    return redirect('/login');
});