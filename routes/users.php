<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)
                    ->only(['create', 'store'])
                    ->middleware(['auth', 'verified', 'permission:all|user.create']);

Route::resource('users', UserController::class)
                    ->only(['edit', 'update'])
                    ->middleware(['auth', 'verified', 'permission:all|user.edit']);
Route::resource('users', UserController::class)
                    ->only(['destroy'])
                    ->middleware(['auth', 'verified', 'permission:all|user.delete']);
Route::resource('users', UserController::class)
                    ->only(['index', 'show'])
                    ->middleware(['auth', 'verified', 'permission:all|user.create|user.edit']);




