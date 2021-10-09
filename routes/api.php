<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Passport

Route::middleware('auth:api')->group( function () {
    Route::resource('shops', 'Api\ShopController');
    Route::resource('products', 'Api\ProductController');
    Route::post('/logout', [AuthController::class, 'logout']);
});


// sanctum

// Route::group(['middleware'=>['auth:sanctum']], function () {
//     Route::resource('shops', 'Api\ShopController');
//     Route::resource('products', 'Api\ProductController');
//     Route::post('/logout', [AuthController::class, 'logout']);
// });
    // Route::post('/login', [AuthController::class, 'login']);
    

