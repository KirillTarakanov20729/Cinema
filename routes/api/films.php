<?php

use Illuminate\Support\Facades\Route;

Route::prefix('films')->group(function() {
    Route::get('/index/{page}', [\App\Http\Controllers\Film\FilmController::class, 'index']);

    Route::get('/{id}/tickets', [\App\Http\Controllers\Film\FilmController::class, 'getTickets']);
});
