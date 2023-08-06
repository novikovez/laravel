<?php

use Illuminate\Support\Facades\Route;


Route::get('/payment_stripe', function () {
    return view('payment_stripe');
});
Route::get('/payment_paypal', function () {
    return view('payment_paypal');
});
Route::get('/payment_liqpay', function () {
    return view('payment_liqpay');
});
