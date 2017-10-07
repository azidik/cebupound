<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;
use App\PetType;
use Validator;
use Auth;
use Illuminate\Support\Facades\File;

class PetController extends Controller
{
    public function list()
    {
        $pets = Pet::all();

        return view('dashboard.admin.pets.list', compact('pets'));
    }

    public function show($id)
    {
        $pet = Pet::find($id);
        $types = PetType::all();
        
        return view('dashboard.admin.pets.details', compact('pet', 'types'));
    }

    public function create(Request $request)
    {
        $types = PetType::all();

        return view('dashboard.admin.pets.create', compact('types'));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'breed_id' => 'required',
            'color' => 'required',
            // 'image' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('images');
                if (!File::exists($destinationPath)) {
                    $fileDir = File::makeDirectory('images');
                }
                $image = $file->getClientOriginalName();
                $file->move($destinationPath, $image);
                $params['image'] = $image;
            }
            $params['pet_category_id'] = 2;
            $params['user_id'] = Auth::user()->id;
            $params['is_accepted'] = 1;
            $pet = Pet::create($params);
            if($pet) {
                session()->flash('message', 'Pet Created...');
                return redirect('/dashboard/admin/pets');
            } else {
                return redirect('/dashboard/admin/pets/create');
            }
        }

    }
    public function update(Request $request, $id)
    {
        $params = $request->all();
        
        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'breed' => 'required',
            'color' => 'required',
            // 'image' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/admin/pets/'.$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('images');
                if (!File::exists($destinationPath)) {
                    $fileDir = File::makeDirectory('images');
                }
                $image = $file->getClientOriginalName();
                $file->move($destinationPath, $image);
                $params['image'] = $image;
            }
            $params['pet_category_id'] = 1;
            $params['user_id'] = Auth::user()->id;
            $pet = Pet::find($id)->update($params);
            if($pet) {
                session()->flash('message', 'Pet updated...');
                return redirect('/dashboard/admin/pets');
            } else {
                return redirect('/dashboard/admin/pets/' .$id);
            }
        }
    }

    public function accept($id) 
    {
        $pet = Pet::find($id)->update([
            'is_accepted' => 1
        ]);

        if($pet) {
            $response = [
                'status' => 1
            ];
        } else {
            $response = [
                'status' => 0
            ];
        }
        return $response;
    }

    public function decline($id) 
    {
        $pet = Pet::find($id)->update([
            'is_accepted' => 2
        ]);

        if($pet) {
            $response = [
                'status' => 1
            ];
        } else {
            $response = [
                'status' => 0
            ];
        }
        return $response;
    }
}
