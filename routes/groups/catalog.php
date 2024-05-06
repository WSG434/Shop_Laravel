<?php

use Domain\Catalog\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::controller(CatalogController::class)->group(function (){
    Route::get('/catalog/{category:slug?}',CatalogController::class)
        ->name('catalog');
});





