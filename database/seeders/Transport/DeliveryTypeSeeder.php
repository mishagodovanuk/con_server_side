<?php

namespace Database\Seeders\Transport;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliveryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryType::updateOrCreate([
           'key' =>'own_delivery',
           'name' => 'Власна доставка'
        ]);

        DeliveryType::updateOrCreate([
            'key' =>'hired_transport',
            'name' => 'Найманий транспорт'
        ]);
    }
}
