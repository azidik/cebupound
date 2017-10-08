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

        foreach ($categories as $category) {
        	FoodCategory::create([
        		'name' => $category
        	]);
        }
    }
}
