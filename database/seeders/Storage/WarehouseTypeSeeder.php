<?php

namespace Database\Seeders\Storage;

use App\Models\WarehouseType;
use Illuminate\Database\Seeder;

class WarehouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WarehouseType::updateOrCreate([
            'key' => 'type1',
            'name' => 'Type1'
        ]);
        WarehouseType::updateOrCreate([
            'key' => 'type2',
            'name' => 'Type2'
        ]);
        WarehouseType::updateOrCreate([
            'key' => 'type3',
            'name' => 'Type3'
        ]);
        WarehouseType::updateOrCreate([
            'key' => 'type4',
            'name' => 'Type4'
        ]);
    }
}
