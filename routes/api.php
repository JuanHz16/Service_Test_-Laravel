<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::patch('/products/{product}', [ProductController::class, 'update']);
