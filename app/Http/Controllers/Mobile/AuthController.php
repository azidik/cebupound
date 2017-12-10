<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $params = $request->all();
        if (Auth::attempt(['username' => $params['username'], 'password' => $params['password']])) {
            // $user = User::where('id', Auth::user()->id)->first();
            // // if($user) {
            // $user->device_token = $params['device_token'];
            // $user->save();

            // $optionBuilder = new OptionsBuilder();
            // $optionBuilder->setTimeToLive(60*20);
            
            // $notificationBuilder = new PayloadNotificationBuilder('Welcome to cebu pound animal');
            // $notificationBuilder->setBody('Hi! This is test auto notification for cebu pound animal')
            //                     ->setSound('default');
                                
            // $dataBuilder = new PayloadDataBuilder();
            // $dataBuilder->addData(['a_data' => 'my_data']);
            
            // $option = $optionBuilder->build();
            // $notification = $notificationBuilder->build();
            // $data = $dataBuilder->build();
            
            // $token = $user->device_token;
            
            // $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            // }
            // Authentication passed...
            $response = [
                'status' => 1,
                'user' => Auth::user()
            ];
        } else {
            $response = [
                'status' => 0
            ];
        }

        return $response;
    }
}
