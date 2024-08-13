<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\APIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/order/create', [APIController::class, 'createOrders']);
Route::post('/order/update', [APIController::class, 'updateOrders']);

Route::post('/product/create', [APIController::class, 'createProducts']);
Route::post('/product/category', [APIController::class, 'createCategory']);
