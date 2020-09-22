<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


    Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reports', 'ReportController@index')->middleware('pages');
Route::get('/reports/{report}', 'ReportController@show')->middleware('pages');

Route::post('/upload', 'UserController@upload');

Route::get('/administration', 'PageController@admin')->middleware('administration');
