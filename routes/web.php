<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('coupons', CouponController::class)
    ->only(['index', 'store']);
