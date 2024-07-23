<?php

namespace Database\Seeders\SKU;

use App\Models\MeasurementUnit;
use Illuminate\Database\Seeder;

class MeasurmentUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeasurementUnit::updateOrCreate([
            'key' => 'box',
            'name' => 'Пачка'
        ]);
        MeasurementUnit::updateOrCreate(
            [
                'key' => 'm2',
                'name' => 'm²'
            ]
        );
    }
}
