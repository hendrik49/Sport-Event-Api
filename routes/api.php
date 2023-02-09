<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users/login', [UserController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::put('/users/{id}/password', [UserController::class, 'changePassword']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);

        Route::resource('organizers', OrganizerController::class);
    });
});