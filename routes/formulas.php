<?php

use App\Http\Controllers\FormulaController;
use Illuminate\Support\Facades\Route;

Route::resource('formulas', FormulaController::class)->middleware(['auth', 'verified', 'permission:all']);