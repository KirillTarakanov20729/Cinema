<?php

use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function() {
    Route::get('/index/{page}', [\App\Http\Controllers\Category\CategoryController::class, 'index']);
});
