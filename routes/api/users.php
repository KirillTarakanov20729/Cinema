<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function() {
    Route::get('index/{page}', [\App\Http\Controllers\User\UserController::class, 'index']);
});
