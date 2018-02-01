<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Answer;


class questionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = ['Are you a pet lover?','Do you have other pets at home?', 'Can you provide the needs of your pet/s?', 'Can someone take care of your pet while you are away?', 'Will you chain/cage your pet?'];

        foreach ($questions as $key => $question) {
            $data = Question::create([
                'name' => $question
            ]);

            $answers = ['Yes', 'No'];

            foreach ($answers as $key => $answer) {
                if($answer == 'Yes')
                    $correct = 1;
                else
                    $correct = 0;
                Answer::create([
                    'name'          => $answer,
                    'is_correct'    => $correct,
                    'question_id'   => $data['id']
                ]);
            }
        }
    }
}
