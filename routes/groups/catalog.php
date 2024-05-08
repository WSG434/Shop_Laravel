<?php

use App\Http\Middleware\CatalogViewMiddleware;
use Domain\Catalog\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::controller(CatalogController::class)->group(function (){
    Route::get('/catalog/{category:slug?}',CatalogController::class)
        ->middleware([CatalogViewMiddleware::class])
        ->name('catalog');
});
