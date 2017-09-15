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
    public function index()
    {
        $questions = Question::all();
        return view('dashboard.pets.exam', compact('questions'));
    }

    public function submit(Request $request)
    {
        $params = $request->all();
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
        $user_exam = UserExam::create([
            'user_id' => Auth::user()->id,
            'score' => $score,
            'take' => 1,
            'remarks' => $result
        ]);
        
        return view('dashboard.pets.result', compact('result', 'score', 'passing'));
    }
}
