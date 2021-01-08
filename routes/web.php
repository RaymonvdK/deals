<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;

Route::get('/', [DealController::class, 'index']);
Route::get('/{filter}', [DealController::class, 'filter']);
Route::get('/deal/{id}', [DealController::class, 'show']);
