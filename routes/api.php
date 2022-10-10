<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\Pure;

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

Route::post('login',[UserController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('user-profile',[UserController::class, 'userProfile']);
    Route::get('ver-mi-agenda',[UserController::class, 'verMiAgenda']);
    Route::post('logout',[UserController::class, 'logout']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
