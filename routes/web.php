<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparisonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/update-comparisons', [ComparisonController::class, 'updateComparisons']);
