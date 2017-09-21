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
Route::post('/deviceToken', function() {
    
});
Route::get('/test', function() {

    $url = 'https://android.googleapis.com/gcm/send';
    $serverApiKey = "";
    $devices = array();
    
    function GCMPushMessage($apiKeyIn){
        $this->serverApiKey = $apiKeyIn;
    }
    function setDevices($deviceIds){
    
        if(is_array($deviceIds)){
            $this->devices = $deviceIds;
        } else {
            $this->devices = array($deviceIds);
        }
    
    }
    function send($message, $data = false){
        
        if(!is_array($this->devices) || count($this->devices) == 0){
            $this->error("No devices set");
        }
        
        if(strlen($this->serverApiKey) < 8){
            $this->error("Server API Key not set");
        }
        
        $fields = array(
            'registration_ids'  => $this->devices,
            'data'              => array( "message" => $message ),
        );
        
        if(is_array($data)){
            foreach ($data as $key => $value) {
                $fields['data'][$key] = $value;
            }
        }
        $headers = array( 
            'Authorization: key=' . $this->serverApiKey,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        
        curl_setopt( $ch, CURLOPT_URL, $this->url );
        
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
        
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        
        curl_close($ch);
        
        return $result;
    }
    
    function error($msg){
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }
    
    $apiKey = "AIzaSyB4VbRPOEzAiJ_wMPWY-Bvh3H5I6LqQ5x0"; //api key
    $devices = array(); //array of tokens
    $message = "The message to send"; //message o send
    
    $gcpm = new GCMPushMessage($apiKey);
    $gcpm->setDevices($devices);
    $response = $gcpm->send($message, array('title' => 'Test title')); //title of the message
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('pets/exams/{pet_id}', 'ExamController@index');
    Route::post('pets/exams/submit', 'ExamController@submit');
    Route::get('pets', 'PetController@index');
    Route::get('pets/create', 'PetController@create');
    Route::post('pets/create', 'PetController@store');
    Route::get('pets/schedules', 'PetController@schedules');
    Route::post('pets/schedules/create', 'PetController@createPetService');
    Route::get('pets/{id}', 'PetController@show');
    Route::get('pets/impound/{id}', 'PetController@proceedToImpound');
    Route::get('pets/adopt/{id}/{pet_id}', 'PetController@proceedToAdopt');
    Route::get('pets/adoption/available', 'PetController@availableAdoption');


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
        Route::get('adoptList', 'Admin\AdoptController@list');
        Route::get('adoptRequest', 'Admin\AdoptController@adoptRequest');
        Route::get('adoptAccept/{id}', 'Admin\AdoptController@adoptAccept');
        Route::get('adoptDecline/{id}', 'Admin\AdoptController@adoptDecline');
        Route::get('serviceSchedules', 'Admin\ServiceController@index');
        Route::get('serviceSchedules/request', 'Admin\ServiceController@request');
        Route::post('serviceSchedule/setDate', 'Admin\ServiceController@setDateSchedule');
        Route::resource('questionsAndAnswers', 'Admin\QuestionAndAnswerController');
        Route::post('questionsAndAnswers/update', 'Admin\QuestionAndAnswerController@update');
        Route::get('reports', 'Admin\ReportController@index');
        Route::get('inventories', 'Admin\InventoryController@index');
        Route::get('inventories/create', 'Admin\InventoryController@create');
        Route::post('inventories/create', 'Admin\InventoryController@store');
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


// For Mobile Route APi only
Route::group(['prefix' => 'mobile'], function () {
    Route::post('/login', 'Mobile\AuthController@login');
    Route::get('/mypets/{userId}', 'Mobile\PetController@mypets');
    Route::post('/mypets/create', 'Mobile\PetController@store');
    Route::get('/mypets/details/{id}', 'Mobile\PetController@show');
    Route::post('/mypets/update/{id}', 'Mobile\PetController@update');
    Route::post('/mypets/service/create', 'Mobile\PetController@createPetService');
}); 
