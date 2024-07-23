<?php

namespace Database\Seeders\Transport;


use App\Models\TransportType;
use Illuminate\Database\Seeder;

class TransportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportType::updateOrCreate([
            'key' => 'type1',
            'name' => 'Type1'
        ]);
        TransportType::updateOrCreate([
            'key' => 'type2',
            'name' => 'Type2',
        ]);
        TransportType::updateOrCreate([
            'key' => 'type3',
            'name' => 'Type3',
        ]);
        TransportType::updateOrCreate([
            'key' => 'type4',
            'name' => 'Type4',
        ]);
        TransportType::updateOrCreate([
            'key' => 'type5',
            'name' => 'Type5',
        ]);
    }
}
