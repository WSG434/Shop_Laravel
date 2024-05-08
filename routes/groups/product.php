<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function (){
    Route::get('/product/{product:slug}',ProductController::class)
        ->name('product');
});
