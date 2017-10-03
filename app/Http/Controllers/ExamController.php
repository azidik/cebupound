<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\PassingRate;
use App\UserExam;
use Auth;

class ExamController extends Controller
{
    public function index($id)
    {   
        $pet_id = $id;
        $passing = PassingRate::find(1);
        $questions = Question::inRandomOrder()->get();
        return view('dashboard.pets.exam', compact('questions', 'pet_id', 'passing'));
    }

    public function submit(Request $request)
    {
        $params = $request->all();  
        // return $params;
        $questions = Question::all();
        $passing = PassingRate::find(1);
        $count = 0;
        foreach($params as $key => $data) {
            $answer = Answer::find($data);
            if($answer['is_correct'])
                $count ++;
        }
    
        $score = round($count * 100 / $questions->count());
        if($score >= $passing->percent)
            $result = 'Passed';
        else
            $result = 'Failed';
        
        $checkUserExam = UserExam::where('user_id', Auth::user()->id)->where('pet_id', $params['pet_id'])->first();
        if($checkUserExam) {
            $checkUserExam->score = $score;
            $checkUserExam->take = $checkUserExam->take + 1;
            $checkUserExam->remarks = $result;
            $checkUserExam->save();
        } else {
            UserExam::create([
                'user_id' => Auth::user()->id,
                'score' => $score,
                'take' => 1,
                'remarks' => $result,
                'pet_id' => $params['pet_id']
            ]);
        }
        
        return view('dashboard.pets.result', compact('result', 'score', 'passing'));
    }
}
