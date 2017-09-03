<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pet;
use App\PetType;
use Auth;
use Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::where('user_id', Auth::user()->id)->get();
        return view('dashboard.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = PetType::all();
        return view('dashboard.pets.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($params, [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'breed' => 'required',
            'color' => 'required',
            'image' => 'required'
        ]);

        if($validator->fails()) {
            return redirect('/dashboard/pets/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = public_path('images');
                if (!File::exists($destinationPath)) {
                    $fileDir = File::makeDirectory('images' . $params['image']);
                }
                $image = $file->getClientOriginalName();
                $file->move($destinationPath, $image);
                $params['image'] = $image;
            }
            $params['pet_category_id'] = 1;
            $params['user_id'] = Auth::user()->id;
            $pet = Pet::create($params);
            if($pet) {
                session()->flash('message', 'Pet created...');
                return redirect('/dashboard/pets');
            } else {
                return redirect('/dashboard/pets/create');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
