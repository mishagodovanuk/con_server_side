<?php

namespace Database\Seeders\Transport;

use App\Models\AdditionalEquipmentBrand;
use Illuminate\Database\Seeder;

class AdditionalEquipmentBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalEquipmentBrand::updateOrCreate([
            'key' => 'brand1',
            'name' => 'Brand1',
        ]);
        AdditionalEquipmentBrand::updateOrCreate([
            'key' => 'brand2',
            'name' => 'Brand2',
        ]);
        AdditionalEquipmentBrand::updateOrCreate([
            'key' => 'brand3',
            'name' => 'Brand3',
        ]);
        AdditionalEquipmentBrand::updateOrCreate([
            'key' => 'brand4',
            'name' => 'Brand4',
        ]);
        AdditionalEquipmentBrand::updateOrCreate([
            'key' => 'brand5',
            'name' => 'Brand5',
        ]);
    }
}
