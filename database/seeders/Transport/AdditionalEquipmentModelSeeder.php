<?php

namespace Database\Seeders\Transport;

use App\Models\AdditionalEquipmentModel;
use Illuminate\Database\Seeder;

class AdditionalEquipmentModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model1',
            'name' => 'Model1',
            'brand_id' => 1
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model1_2',
            'name' => 'Model1_2',
            'brand_id' => 1
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model1_3',
            'name' => 'Model1_3',
            'brand_id' => 1
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model2_1',
            'name' => 'Model2_1',
            'brand_id' => 2
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model2_2',
            'name' => 'Model2_2',
            'brand_id' => 2
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model2_3',
            'name' => 'Model2_3',
            'brand_id' => 2
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model3_1',
            'name' => 'Model3_1',
            'brand_id' => 3
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model4_1',
            'name' => 'Model4_1',
            'brand_id' => 4
        ]);
        AdditionalEquipmentModel::updateOrCreate([
            'key' => 'model5_1',
            'name' => 'Model5_1',
            'brand_id' => 5
        ]);
    }
}
