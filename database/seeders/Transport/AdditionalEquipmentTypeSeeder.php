<?php

namespace Database\Seeders\Transport;

use App\Models\AdditionalEquipmentType;
use Illuminate\Database\Seeder;

class AdditionalEquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalEquipmentType::updateOrCreate([
            'key' => 'a_type1',
            'name' => 'A_type1'
        ]);
        AdditionalEquipmentType::updateOrCreate([
            'key' => 'a_type2',
            'name' => 'A_type2',
        ]);
        AdditionalEquipmentType::updateOrCreate([
            'key' => 'a_type3',
            'name' => 'A_type3',
        ]);
        AdditionalEquipmentType::updateOrCreate([
            'key' => 'a_type4',
            'name' => 'A_type4',
        ]);
        AdditionalEquipmentType::updateOrCreate([
            'key' => 'a_type5',
            'name' => 'A_type5',
        ]);
    }
}
