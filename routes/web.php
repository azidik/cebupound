<?php

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

//------------GUEST-------------//
Route::get('/', 'HomeController@guest');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('pets', 'PetController@index');
    Route::get('pets/create', 'PetController@create');
    Route::post('pets/create', 'PetController@store');
});


Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/logout', 'Auth\AuthController@logout');