<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MprController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);
Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);
Route::resource('projects', ProjectController::class)->middleware(['auth', 'verified']);
Route::resource('mprs', MprController::class)->middleware(['auth', 'verified']);

require __DIR__.'/users.php';
require __DIR__.'/roles.php';
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
