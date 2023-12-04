<?php

use App\Http\Controllers\ApiCategoryController;
use App\Http\Controllers\ApiCompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'message' => 'success'
    ]);
});



Route::apiResource('categories', ApiCategoryController::class);
Route::apiResource('companies', ApiCompanyController::class);