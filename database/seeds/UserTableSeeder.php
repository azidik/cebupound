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
            'address' => 'F. Cabahug North Reclamation',
            'contact_no' => 13,
            'username' => 'administrator',
            'email' => 'cebupound@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);
    }
}
