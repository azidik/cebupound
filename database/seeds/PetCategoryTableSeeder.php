<?php

use Illuminate\Database\Seeder;
use App\PetCategory;

class PetCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Sheltered', 'Stray'];

        foreach ($types as $key => $type) {
            PetCategory::create([
                'name' => $type
            ]);
        }
    }
}
