<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockEntryController;
use App\Http\Controllers\SaleController;


Route::apiResource('products', ProductController::class);
Route::apiResource('stock-entries', StockEntryController::class);
Route::apiResource('sales', SaleController::class);
