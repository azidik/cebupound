<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(base_path('resources/assets/js/cities.json')), true);
        $count = 0;
        if (isset($data['RECORDS']) && !empty($data['RECORDS'])) {
            foreach ($data['RECORDS'] as $item) {
                $result = \App\City::create([
                    'id' => $item['citymunCode'],
                    'description' => $item['citymunDesc'],
                    'psgc_code' => $item['psgcCode']
                ]);
                $count++;
            }
        }

        $this->command->info('Cities seeded: '.$count);
    }
}
