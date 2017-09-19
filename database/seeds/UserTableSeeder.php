<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Administrator',
            'last_name' => 'Administrator',
            'address' => 'Block 9 Lot 3 Palm River Subdivision',
            'contact_no' => 13,
            'username' => 'admin',
            'email' => 'administrator@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);
    }
}
