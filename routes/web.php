<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/sales', [SaleController::class, 'index']);