<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use App\Impound;
use PDF;
use App\Adopt;

class PrintController extends Controller
{
    public function printImpound($impound)
    {
        $impound = Impound::find($impound);
        $pdf = PDF::loadView('dashboard.admin.pdf.impound', compact('impound'));
        return $pdf->stream('impound-information.pdf');
    }

    public function printAdopt($adopt)
    {
        $adopt = Adopt::find($adopt);
        $pdf = PDF::loadView('dashboard.admin.pdf.adopt', compact('adopt'));
        return $pdf->stream('adopt-information.pdf');
    }

    public function printRegistered($registered)
    {
        $registered = Pet::find($registered);
        $pdf = PDF::loadView('dashboard.admin.pdf.registered', compact('registered'));
        return $pdf->stream('registered-information.pdf');
    }

    public function printRegisteredAll()
    {
        $pets = Pet::all();
        $pdf = PDF::loadView('dashboard.admin.pdf.registeredAll', compact('pets'));
        return $pdf->stream('registered-information.pdf');
    }

    public function printImpoundAllDogs()
    {
        $impounds = Impound::whereHas('pet', function($query) {
            $query->where('pet_type_id', 1);
        })->get();
        $pdf = PDF::loadView('dashboard.admin.pdf.impoundAll', compact('impounds'));
        return $pdf->stream('impound-information.pdf');
    }

    public function printImpoundAllCats()
    {
        $impounds = Impound::whereHas('pet', function($query) {
            $query->where('pet_type_id', 2);
        })->get();
        $pdf = PDF::loadView('dashboard.admin.pdf.impoundAll', compact('impounds'));
        return $pdf->stream('impound-information.pdf');
    } 
    
    public function printAdoptAll()
    {
        $adopts = Adopt::all();
        $pdf = PDF::loadView('dashboard.admin.pdf.adoptAll', compact('adopts'));
        return $pdf->stream('adopt-information.pdf');
    }
}
