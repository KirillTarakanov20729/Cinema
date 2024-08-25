<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tickets')->group(function() {
    Route::get('/index/{page}', [\App\Http\Controllers\Ticket\TicketController::class, 'index']);
});
