<?php

use Illuminate\Database\Seeder;
use App\PassingRate;

class PassingRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PassingRate::create([
        	'percent' => 20,
        	'count_question' => 5
        ]);
    }
}
