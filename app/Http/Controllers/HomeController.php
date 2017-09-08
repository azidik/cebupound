<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Impound;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function guest()
    {
        return view('guest.home');
    }

    public function adoption()
    {
        $impoudings = Impound::where('is_accepted', 1)->get();

        return view('guest.adoption', compact('impoudings'));
    }

    public function about()
    {
        return view('guest.about');
    }

    public function contact()
    {
        return view('guest.contact');
    }
}
