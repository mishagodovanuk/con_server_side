<?php

namespace Database\Seeders\Transport;

use App\Models\Adr;
use Illuminate\Database\Seeder;

class AdrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adr::updateOrCreate([
            'key' => 'adr1',
            'name' => 'Adr1'
        ]);
        Adr::updateOrCreate([
            'key' => 'adr2',
            'name' => 'Adr2',
        ]);
        Adr::updateOrCreate([
            'key' => 'adr3',
            'name' => 'Adr3',
        ]);
        Adr::updateOrCreate([
            'key' => 'adr4',
            'name' => 'Adr4',
        ]);
        Adr::updateOrCreate([
            'key' => 'adr5',
            'name' => 'Adr5',
        ]);
    }
}
