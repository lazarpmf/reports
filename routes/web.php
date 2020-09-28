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


    // Auth::routes();

    Route::get('login', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@showLoginForm'
      ]);
      Route::post('login', [
        'as' => '',
        'uses' => 'Auth\LoginController@login'
      ]);
      Route::post('logout', [
        'as' => 'logout',
        'uses' => 'Auth\LoginController@logout'
      ]);
      
      // Password Reset Routes...
      Route::post('password/email', [
        'as' => 'password.email',
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
      ]);
      Route::get('password/reset', [
        'as' => 'password.request',
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
      ]);
      Route::post('password/reset', [
        'as' => 'password.update',
        'uses' => 'Auth\ResetPasswordController@reset'
      ]);
      Route::get('password/reset/{token}', [
        'as' => 'password.reset',
        'uses' => 'Auth\ResetPasswordController@showResetForm'
      ]);
      


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reports', 'ReportController@index')->middleware('pages');
Route::get('/reports/{report}', 'ReportController@show')->middleware('pages');

Route::post('/upload', 'UserController@upload');

Route::get('/administration', 'PageController@admin')->middleware('administration');

Route::get('/statistics', 'StatisticController@index')->middleware('administration');
