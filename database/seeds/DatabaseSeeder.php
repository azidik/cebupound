<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PetTypeTableSeeder::class);
        $this->call(PetCategoryTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
