<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = ['Deworming', 'Mange Treatment', 'Spay and Neuter', 'Rabies Vaccination', 'Basic Medical Consultation'];
        foreach ($services as $key => $service) {
            Service::create([
                'name' => $service
            ]);
        }
    }
}
