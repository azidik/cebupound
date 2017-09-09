<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pet;

class PetController extends Controller
{
    public function store()
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
            return $validator->errors();
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
    public function mypets($userId)
    {
        $pets = Pet::with('type')->where('user_id', $userId)->get();
        return $pets;
    }
}
