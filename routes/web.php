<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSaleContrller;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    // * Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // * Products
    Route::prefix("products")->group(function () {

        // * Reports
        Route::middleware(IsAdmin::class)->group(function () {
            Route::get('/reports', [ProductController::class, 'reportList'])->name('product.report.list');
            Route::get('/reports/show/{saleReport}', [ProductController::class, 'showReport'])->name('product.report.show');
            Route::get('/reports/create', [ProductController::class, 'createReport'])->name('product.report.create');
            Route::post('/reports/store', [ProductController::class, 'storeReport'])->name('product.report.store');
        });

        // * Products
        Route::get('/', [ProductController::class, 'index'])->name('product.list');

        Route::middleware(IsAdmin::class)->group(function () {
            Route::get('/new', [ProductController::class, 'create'])->name('product.create');
            Route::post('/create', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
            Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.delete');
        });

        Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');



        // * Product Sales
        Route::prefix("sales")->group(function () {
            Route::post('/{product}', [ProductSaleContrller::class, 'sale'])->name('product.sale');
        });
    });
});

require __DIR__ . '/auth.php';
