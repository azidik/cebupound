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
        // return $registered;
        $pdf = PDF::loadView('dashboard.admin.pdf.registered', compact('registered'));
        // return $pdf;
        return $pdf->stream('registered-information.pdf', array("Attachment" => false));
    }

    public function printRegisteredPet(Request $request)
    {
        if($request->category == 'all' && $request->type == 'all') {
            $pets = Pet::all();
        } else if ($request->category == 'all') {
            $pets = Pet::where('pet_type_id', $request->type)->get();
        } else if($request->type == 'all') {
            $pets = Pet::where('pet_category_id', $request->category)->get();   
        } else {
            $pets = Pet::where('pet_category_id', $request->category)->where('pet_type_id', $request->type)->get();
        }
        $pdf = PDF::loadView('dashboard.admin.pdf.registeredAll', compact('pets'));
        return $pdf->stream('registered-information.pdf', array("Attachment" => false));
        
    }

    public function printImpoundPet(Request $request)
    {
        $impounds = Impound::whereHas('pet', function($query) use ($request) {
            if ($request->category == 'all') {
                $query->where('pet_type_id', $request->type);
            } else if($request->type == 'all') {  
                $query->where('pet_category_id', $request->category);
            } else {
                // $pets = Pet::where('pet_category_id', $request->category)->where('pet_type_id', $request->type)->get();
                $query->where('pet_category_id', $request->category)->where('pet_type_id', $request->type);
            }
        })->get();
        $pdf = PDF::loadView('dashboard.admin.pdf.impoundAll', compact('impounds'));
        return $pdf->stream('impound-information.pdf');
    }

    public function printRegisteredAllCats()
    {
        $pets = Pet::where('pet_type_id', 2)->get();
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
    
    public function printAdoptAllDogs()
    {
        $adopts = Adopt::whereHas('impound', function($query) {
            $query->whereHas('pet', function($d) {
                $d->where('pet_type_id', 1);
            });
        })->get();
        $pdf = PDF::loadView('dashboard.admin.pdf.adoptAll', compact('adopts'));
        return $pdf->stream('adopt-information.pdf');
    }

    public function printAdoptAllCats()
    {
        $adopts = Adopt::whereHas('impound', function($query) {
            $query->whereHas('pet', function($d) {
                $d->where('pet_type_id', 2);
            });
        })->get();
        $pdf = PDF::loadView('dashboard.admin.pdf.adoptAll', compact('adopts'));
        return $pdf->stream('adopt-information.pdf');
    }
}
