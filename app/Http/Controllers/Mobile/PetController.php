<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;

class PetController extends Controller
{
    public function mypets($userId)
    {
        $pets = Pet::with('type')->where('user_id', $userId)->get();
        return $pets;
    }
}
