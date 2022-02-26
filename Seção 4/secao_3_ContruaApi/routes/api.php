<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Models\Product;
use App\Http\Controllers\Api\CarsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('product')->group(function () {
    Route::post('save', [ProductController::class, 'save']);
    Route::get('all', [ProductController::class, 'index']);
    Route::get('show/{id}', [ProductController::class, 'show']);
});

Route::prefix('cars')->group(function () {
    Route::post('create', [CarsController::class, 'store']);
    Route::get('show/{id}', [CarsController::class, 'show']);
    Route::get('read', [CarsController::class, 'index']);
});
