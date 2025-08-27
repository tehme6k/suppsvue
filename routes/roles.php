<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::resource('permissions', PermissionController::class)->middleware(['auth', 'verified', 'permission:all']);

Route::resource('roles', RoleController::class)
                    ->only(['create', 'store'])
                    ->middleware(['auth', 'verified', 'permission:all|role.create']);

Route::resource('roles', RoleController::class)
                    ->only(['edit', 'update'])
                    ->middleware(['auth', 'verified', 'permission:all|role.edit']);

Route::resource('roles', RoleController::class)
                    ->only(['destroy'])
                    ->middleware(['auth', 'verified', 'permission:all|role.delete']);

Route::resource('roles', RoleController::class)
                    ->only(['index', 'show'])
                    ->middleware(['auth', 'verified', 'permission:all|role.create|role.edit']);

