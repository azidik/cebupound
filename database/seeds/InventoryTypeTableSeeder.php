<?php

use Illuminate\Database\Seeder;
use App\InventoryType;

class InventoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Food', 'Medicine'];

        foreach ($types as $key => $type) {
        	InventoryType::create([
        		'name' => $type
        	]);
        }
    }
}
