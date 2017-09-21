<?php

use Illuminate\Database\Seeder;
use App\MedicineCategory;

class MedicineCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Syrup', 'Tablet'];

        foreach ($categories as $key => $category) {
        	MedicineCategory::create([
        		'name' => $category
        	]);
        }
    }
}
