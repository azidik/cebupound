<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Pet;
use App\PetType;
use App\PetCategory;
use App\User;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Impound;
use App\Adopt;
use App\PetService;
use App\UserExam;
use App\Service;

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
                    $fileDir = File::makeDirectory('images');
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
        $users = User::all();
        $categories = PetCategory::all();
        $types = PetType::all();
        $pet = Pet::find($id);
        return view('dashboard.pets.details', compact('pet', 'types'));
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

    public function proceedToImpound($id) {
        $impound = Impound::create([
            'pet_id' => $id
        ]);
        if($impound) {
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
    public function availableAdoption()
    {
        $available_adoptions = Impound::where('is_accepted', 1)->get();
        return view('dashboard.pets.available', compact('available_adoptions'));
    }

    public function proceedToAdopt($id){

        // $impound = Impound::find($id)

        $checkUserExam = UserExam::where('user_id', Auth::user()->id)->first();
        if($checkUserExam) {
            if($checkUserExam->remarks == 'Passed') {
                $adopt = Adopt::create([
                    'impound_id' => $id,
                    'adopted_at' => Carbon::now()->toDateTimeString(),
                    'adopted_by' => Auth::user()->id
        
                ]);
                $response = [
                    'status' => 1,
                    'canAdopt' => 1
                ];
            } else {
                $response = [
                    'status' => 2,
                    'canAdopt' => 0
                ];
            }
        } else {
            $response = [
                'status' => 0,
                'canAdopt' => 0
            ];
        }
         
        return $response;
    }

    public function schedules()
    {
        $pets = Pet::where('user_id', Auth::user()->id)->get();
        $services = Service::all();
        return view('dashboard.pets.schedule', compact('pets', 'services'));
    }

    public function createPetService(Request $request)
    {
        $params = $request->all();

        $pet_service  = PetService::create([
            'pet_id' => $params['pet_id'],
            'service_id' => $params['service_id'],
            'status' => 'Request'
        ]);

        if($pet_service) {
            $response = [
                'status' => 1,
                'pet_service' => $pet_service 
            ];
        } else {
            $response = [
                'status' => 0   
            ];
        }
        return $response;
    }
}
