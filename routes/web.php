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
Route::get('/adopt', 'HomeController@adoption');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('pets', 'PetController@index');
    Route::get('pets/create', 'PetController@create');
    Route::post('pets/create', 'PetController@store');
    Route::get('pets/{id}', 'PetController@show');
    Route::get('pets/impound/{id}', 'PetController@proceedToImpound');

    // Admin
    Route::group(['prefix' => 'admin'], function () { 
        Route::get('impoundRequest', 'Admin\ImpoundController@impoudRequest');
        Route::get('impoundAccept/{id}', 'Admin\ImpoundController@impoundAccept');
        Route::get('impoundDecline/{id}', 'Admin\ImpoundController@impoundDecline');
        Route::get('pets', 'Admin\PetController@list');
        Route::get('pets/create', 'Admin\PetController@create');
        Route::get('pets/{id}', 'Admin\PetController@show');
        Route::post('pets/update/{id}', 'Admin\PetController@update');
        Route::get('impoundList', 'Admin\ImpoundController@list');
    });
});


Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/logout', 'Auth\AuthController@logout');


// For Mobile Route APi only
Route::group(['prefix' => 'mobile'], function () {
    Route::post('/login', 'Mobile\AuthController@login');
    Route::get('/mypets/{userId}', 'Mobile\PetController@mypets');
}); 
