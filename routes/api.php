<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerGameController;
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

Route::post('/login', [UserController::class, 'login']);
Route::get('/players', [PlayerController::class, 'index']);
Route::get('/games', [GameController::class, 'index']);
Route::get('/player-games', [PlayerGameController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::post('/player-games', [PlayerGameController::class, 'store']);
    Route::get('/player-games/{player}', [PlayerGameController::class, 'show']);
    Route::put('/player-games/{player}', [PlayerGameController::class, 'update']);
    Route::delete('/player-games/{player}', [PlayerGameController::class, 'destroy']);
});
