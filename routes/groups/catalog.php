<?php

use App\Http\Controllers\CatalogController;
use App\Http\Middleware\CatalogViewMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(CatalogController::class)->group(function (){
    Route::get('/catalog/{category:slug?}',CatalogController::class)
        ->middleware([CatalogViewMiddleware::class])
        ->name('catalog');
});
