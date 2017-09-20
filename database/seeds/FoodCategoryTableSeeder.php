<?php

use Illuminate\Database\Seeder;
use App\FoodCategory;

class FoodCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Dry', 'Canned', 'Semi-Moist'];

        foreach ($categories as $key => $category) {
        	FoodCategory::create([
        		'name' => $category
        	]);
        }
    }
}
