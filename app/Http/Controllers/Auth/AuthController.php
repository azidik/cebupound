<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:users',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    public function getLogin() 
    {
        return view('auth.login');
    }

    public function getRegister() 
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($params, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'contact_no' => 'required|min:11|max:13',
            'username' => 'required|min:5|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required|min:5'
        ]);

        if($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        } else {
            $params['password'] = bcrypt($params['password']);
            $user = User::create($params);
            if($user) {
                return redirect('/login');
            } else {
                return redirect('/register');
            }
        }
    }

    public function postLogin (Request $request)
    {
        $params = $request->all();

        if (Auth::attempt(['username' => $params['username'], 'password' => $params['password']])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        } else {
            session()->flash('message', 'Invalid username/password. Try again.');
            return redirect('/login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
