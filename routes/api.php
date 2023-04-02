<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\Api\CatalogController;

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


Route::prefix('v1')->group(function () {

    //middleware(['auth:sanctum'])->
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::apiResource('users', UserController::class);
        Route::apiResource('catalog', CatalogController::class);
        Route::apiResource('ticket', TicketController::class);
        Route::post('change-password/{user}', [UserController::class, 'changePassword']);

    });

    Route::post('login', [UserController::class, 'login']);

});