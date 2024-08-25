<?php

use Illuminate\Support\Facades\Route;

Route::prefix('payments')->group(function() {
    Route::post('/store', [\App\Http\Controllers\Payment\PaymentController::class, 'store']);

    Route::get('/redirect/{payment_uuid}', [\App\Http\Controllers\Payment\PaymentController::class, 'redirect']);

    Route::get('/success/{payment_uuid}', [\App\Http\Controllers\Payment\PaymentController::class, 'success']);

    Route::get('/failure/{payment_uuid}', [\App\Http\Controllers\Payment\PaymentController::class, 'failure']);

    Route::post('/callback', [\App\Http\Controllers\Payment\PaymentController::class, 'callback']);
});
