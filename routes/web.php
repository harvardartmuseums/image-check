<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\RatioComparisonController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/update-comparisons', [ComparisonController::class, 'updateComparisons']);
Route::get('/update-ratio-comparisons', [RatioComparisonController::class, 'updateRatioComparisons']);
