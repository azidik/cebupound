<?php

use Illuminate\Database\Seeder;

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
            Question::create([
                'name' => $question
            ]);
        }
    }
}
