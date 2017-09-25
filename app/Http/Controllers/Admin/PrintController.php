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
        return $pdf->download('impound-information.pdf');
    }

    public function printAdopt($adopt)
    {
        $adopt = Adopt::find($adopt);
        $pdf = PDF::loadView('dashboard.admin.pdf.adopt', compact('adopt'));
        return $pdf->download('adopt-information.pdf');
    }

    public function printRegistered($registered)
    {
        $registered = Pet::find($registered);
        $pdf = PDF::loadView('dashboard.admin.pdf.registered', compact('registered'));
        return $pdf->download('registered-information.pdf');
    }

    public function printRegisteredAll()
    {
        $pets = Pet::all();
        $pdf = PDF::loadView('dashboard.admin.pdf.registeredAll', compact('pets'));
        return $pdf->download('registered-information.pdf');
    }

    public function printImpoundAll()
    {
        $impounds = Impound::all();
        $pdf = PDF::loadView('dashboard.admin.pdf.impoundAll', compact('impounds'));
        return $pdf->download('impound-information.pdf');
    } 
    
    public function printAdoptAll()
    {
        $adopts = Adopt::all();
        $pdf = PDF::loadView('dashboard.admin.pdf.adoptAll', compact('adopts'));
        return $pdf->download('adopt-information.pdf');
    }
}
