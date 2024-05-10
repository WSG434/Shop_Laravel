<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->group(function (){
    Route::get('/order','index')->name('order');
    Route::post('/order','handle')->name('order.handle');
});
