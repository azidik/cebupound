<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $params = $request->all();
        if (Auth::attempt(['username' => $params['username'], 'password' => $params['password']])) {
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
