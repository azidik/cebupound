<?php

use Illuminate\Database\Seeder;

class BarangayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents(base_path('resources/assets/js/barangay.json')), true);
        $count = 0;
        if (isset($data['RECORDS']) && !empty($data['RECORDS'])) {
            foreach ($data['RECORDS'] as $item) {
                $result = \App\Barangay::create([
                    'id' => $item['brgyCode'],
                    'description' => $item['brgyDesc'],
                    'psgc_code' => $item['psgcCode'] ?? '',
                    'city_id' => $item['citymunCode']
                ]);
                $count++;
            }
        }

        $this->command->info('Barangays seeded: '.$count);
    }
}
