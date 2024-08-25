<?php

use Illuminate\Support\Facades\Route;

Route::prefix('actors')->group(function() {
    Route::get('/index/{page}', [\App\Http\Controllers\Actor\ActorController::class, 'index']);
});
