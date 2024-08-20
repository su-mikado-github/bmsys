<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/users-attest', [ \App\Http\Controllers\Api\UsersController::class, 'attest' ]);

Route::group(['middleware'=>['auth:sanctum']], function() {
    Route::get('/users', [ \App\Http\Controllers\Api\UsersController::class, 'get' ]);
    Route::post('/logout', [ \App\Http\Controllers\Api\UsersController::class, 'logout' ]);
});
