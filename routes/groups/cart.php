<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)
    ->prefix('cart')
    ->group(function (){
        Route::get('/', 'index')->name('cart');
        Route::post('/{product}/add', 'add')->name('cart.add');
        Route::post('/{item}/quantity', 'quantity')->name('cart.quantity');
        Route::delete('/{item}/delete', 'delete')->name('cart.delete');
        Route::delete('/truncate', 'truncate')->name('cart.truncate');
});
