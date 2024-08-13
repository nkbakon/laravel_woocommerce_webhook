<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\APIController;
use \App\Http\Controllers\ProductController;

Route::get('/', [APIController::class, 'index'])->name('index');
Route::get('orders/{order}/view', [APIController::class, 'view'])->name('orders.view');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/get/orders', [APIController::class, 'getOrders']);
Route::get('/create/products', [ProductController::class, 'createProduct']);
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/category', [ProductController::class, 'category'])->name('products.category');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
