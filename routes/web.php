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
Route::get('/FAQs', 'HomeController@faqs');
Route::post('/deviceToken', function() {
    
});
// For authenticared user route only
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('profile', 'ProfileController@show');
    Route::post('profile/update/{id}', 'ProfileController@update');
    Route::get('pets/exams/{pet_id}', 'ExamController@index');
    Route::post('pets/exams/submit', 'ExamController@submit');
    Route::get('pets', 'PetController@index');

    Route::get('pets/to-impound', 'PetController@impound');
    Route::get('pets/to-adopt', 'PetController@adopt');

    Route::get('pets/create', 'PetController@create');
    Route::post('pets/create', 'PetController@store');
    Route::get('pets/schedules', 'PetController@schedules');
    Route::post('pets/schedules/create', 'PetController@createPetService');
    Route::get('pets/{id}', 'PetController@show');
    Route::post('pets/impound', 'PetController@proceedToImpound');
    Route::get('pets/adopt/{id}/{pet_id}', 'PetController@proceedToAdopt');
    Route::get('pets/adoption/available', 'PetController@availableAdoption');
    Route::get('/pets/type/{id}', 'Mobile\PetController@breed');

    // Admin
    Route::group(['prefix' => 'admin'], function () {
        Route::get('impoundRequest', 'Admin\ImpoundController@impoudRequest');
        Route::get('impoundAccept/{id}', 'Admin\ImpoundController@impoundAccept');
        Route::get('impoundDecline/{id}', 'Admin\ImpoundController@impoundDecline');
        Route::get('pets', 'Admin\PetController@list');
        Route::get('pets/create', 'Admin\PetController@create');
        Route::post('pets/create', 'Admin\PetController@store');
        Route::get('pets/accept/{id}', 'Admin\PetController@accept');
        Route::get('pets/decline/{id}', 'Admin\PetController@decline');
        Route::get('pets/request', 'Admin\PetController@request');
        // Route::get('pets/search/{data}', 'Admin\PetController@search');
        Route::get('pets/{id}', 'Admin\PetController@show');
        Route::post('pets/update/{id}', 'Admin\PetController@update');
        Route::get('pets/pdf/impound/{id}', 'Admin\PrintController@printImpound');
        Route::get('pets/pdf/adopt/{id}', 'Admin\PrintController@printAdopt');
        Route::get('pets/pdf/registered/{id}', 'Admin\PrintController@printRegistered');
        Route::get('pets/pdf/registeredAll/dogs', 'Admin\PrintController@printRegisteredAllDogs');
        Route::get('pets/pdf/registeredAll/cats', 'Admin\PrintController@printRegisteredAllCats');
        Route::get('pets/pdf/impoundAll/dogs', 'Admin\PrintController@printImpoundAllDogs');
        Route::get('pets/pdf/impoundAll/cats', 'Admin\PrintController@printImpoundAllCats');
        Route::get('pets/pdf/adoptAll/dogs', 'Admin\PrintController@printAdoptAllDogs');
        Route::get('pets/pdf/adoptAll/cats', 'Admin\PrintController@printAdoptAllCats');
        Route::get('impoundList', 'Admin\ImpoundController@list');
        Route::get('adoptList', 'Admin\AdoptController@list');
        Route::get('adoptRequest', 'Admin\AdoptController@adoptRequest');
        Route::get('adoptAccept/{id}', 'Admin\AdoptController@adoptAccept');
        Route::get('adoptDecline/{id}', 'Admin\AdoptController@adoptDecline');
        Route::get('serviceSchedules', 'Admin\ServiceController@index');
        Route::get('serviceSchedules/request', 'Admin\ServiceController@request');
        Route::resource('questionsAndAnswers', 'Admin\QuestionAndAnswerController');
        Route::post('questionsAndAnswers/update', 'Admin\QuestionAndAnswerController@update');
        Route::get('inventory/reports', 'Admin\ReportController@index');
        Route::get('inventory/foodList', 'Admin\ReportController@foodList');
        Route::get('inventory/medicineList', 'Admin\ReportController@medicineList');
        Route::get('inventory/createFood', 'Admin\ReportController@createFood');
        Route::get('inventory/createMedicine', 'Admin\ReportController@createMedicine');
        Route::post('inventory/food/create', 'Admin\ReportController@storeFood');
        Route::get('inventory/foodList', 'Admin\ReportController@foodList');
        Route::post('inventory/medicine/create', 'Admin\ReportController@storeMedicine');
        Route::get('inventory/medicineList', 'Admin\ReportController@medicineList');
        Route::post('serviceSchedule/setDate', 'Admin\ServiceController@setDateSchedule');
        Route::get('inventory/report/{barangay_id}/{reportName}', 'Admin\ReportController@checkReport');
    });
});

// Pubic routes
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/logout', 'Auth\AuthController@logout');
Route::get('/forgot', 'Auth\PasswordController@forgot');
Route::get('/reset', 'Auth\PasswordController@reset');
Route::post('/reset', 'Auth\PasswordController@postReset');
Route::post('/password/email', 'Auth\PasswordController@email');
Route::post('serviceSchedule/setDate', 'Admin\ServiceController@setDateSchedule');

// For Mobile Route APi only
Route::group(['prefix' => 'mobile'], function () {
    Route::post('/login', 'Mobile\AuthController@login');
    Route::get('/notifications/{id}', 'Mobile\PetController@notifications');
    Route::get('/histories/{id}', 'Mobile\PetController@histories');
    Route::get('/mypets/{userId}', 'Mobile\PetController@mypets');
    Route::post('/mypets/create', 'Mobile\PetController@store');
    Route::get('/mypets/details/{id}', 'Mobile\PetController@show');
    Route::post('/mypets/update/{id}', 'Mobile\PetController@update');
    Route::post('/mypets/service/create', 'Mobile\PetController@createPetService');
    Route::get('/mypets/service/schedules/{id}', 'Mobile\PetController@schedules');
    Route::get('/mypets/type/{id}', 'Mobile\PetController@breed');
}); 
