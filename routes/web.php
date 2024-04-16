<?php

use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/sales', [SaleController::class, 'index']);
Route::get('/stocks', [StockController::class, 'index']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/charts', [ChartController::class, 'charts'])->name('charts');
Route::get('/graphs', [HomeController::class, 'graphs'])->name('graphs');
Route::get('/analytics', [AnalyticController::class, 'analytics'])->name('analytics');
