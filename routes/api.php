<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\ReportController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('user', 'Api\UserController');
    Route::apiResource('report', 'Api\ReportController');
    Route::apiResource('project', 'Api\ProjectController');
    Route::apiResource('status', 'Api\StatusController');
    // Route::post('/upload', 'Api\UserController@upload');
});

