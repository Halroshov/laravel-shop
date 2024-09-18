<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

Route::get('/', [ProductController::class, 'dashboard'])->name('dashboard');

// 产品查询路由（放在资源路由之前）
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// 产品资源路由
Route::resource('products', ProductController::class);

// 新增的路由
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);
