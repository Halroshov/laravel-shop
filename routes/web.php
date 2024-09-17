<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

Route::get('/', [ProductController::class, 'dashboard'])->name('dashboard');

// 产品资源路由
Route::resource('products', ProductController::class);

// 如果你想单独定义路由,可以使用以下方式:
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// 新增的路由
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);