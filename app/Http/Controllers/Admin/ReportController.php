<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use App\PetService;
use App\Impound;

class ReportController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        $impoundings = Impound::with('pet')->get();
        $pet_shelter = [];

        foreach($impoundings as $impounding) {
                
            $pet_shelter[] = $impounding->pet->where('pet_category_id', 1)->first();
            $pet_stray[] = $impounding->pet->where('pet_category_id', 2)->first();
        }

        $pet_services = PetService::where('status', 'Confirmed')->get();
        return view('dashboard.admin.reports.statistical', compact('pets', 'impoundings', 'pet_shelter', 'pet_stray', 'pet_services'));
    }
}
