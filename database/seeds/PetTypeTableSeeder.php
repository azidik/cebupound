<?php

use Illuminate\Database\Seeder;
use App\PetType;

class PetTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Dog', 'Cat'];

        foreach ($types as $key => $type) {
            PetType::create([
                'name' => $type
            ]);
        }
    }
}
