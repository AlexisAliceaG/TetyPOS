<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleReportController;
use App\Http\Controllers\ProductReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('sales.create');
})->middleware(['auth', 'verified', 'role:admin|cajero'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['role:admin|cajero', 'can:crear ventas'])->group(function () {
        Route::get('/ventas/crear', [SaleController::class, 'create'])->name('sales.create');    
        Route::post('/ventas', [SaleController::class, 'store'])->name('sales.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    
    Route::resource('users', UserController::class)->names('users')->middleware([
        'index' => 'can:ver usuarios',
        'create' => 'can:crear usuarios',
        'edit' => 'can:editar usuarios',
        'destroy' => 'can:eliminar usuarios'
    ]);

    Route::resource('products', ProductController::class)->middleware([
        'index' => 'can:ver productos',
        'create' => 'can:crear productos',
        'edit' => 'can:editar productos',
        'destroy' => 'can:eliminar productos'
    ]);
    
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    
    Route::middleware(['can:ver reportes'])->group(function () {
        Route::get('/reporte-ventas', [SaleReportController::class, 'index'])->name('reports.sales');
        Route::get('/reporte-productos', [ProductReportController::class, 'index'])->name('reports.products');
    });
});

require __DIR__.'/auth.php';