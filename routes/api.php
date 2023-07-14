<?php

use App\Http\Controllers\SocketsController;
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

// Route::post('/sockets/connect', [SocketsController::class, 'connect']);


Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/users/create', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);

Route::get('/users/edit/{id}', [UserController::class, 'edit']);

Route::put('/users/{id}', [UserController::class, 'update']);

