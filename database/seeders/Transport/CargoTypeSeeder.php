<?php

namespace Database\Seeders\Transport;

use App\Models\CargoType;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CargoType::updateOrCreate([
            'key' => 'product'],
            ['name' => 'Продукти харчування, б/а напої без дотримання температурного режиму'
            ]);

        CargoType::updateOrCreate([
            'key' => 'product_t'],
            ['name' => 'Продукти харчування з дотриманням температурного режиму'
            ]);

        CargoType::updateOrCreate([
            'key' => 'pobut'],
            ['name' => 'Побутові та господарські товари'
            ]);

        CargoType::updateOrCreate([
            'key' => 'vydub_prom'],
            ['name' => 'Продукція видобувної промисловості'
            ]);

        CargoType::updateOrCreate([
            'key' => 'textile'],
            ['name' => 'Текстильні товари'
            ]);

        CargoType::updateOrCreate([
            'key' => 'bud_material'],
            ['name' => 'Будівельні матеріали, інструменти, сировина для будівництва, сантехніка'
            ]);

        CargoType::updateOrCreate([
            'key' => 'poligraph_prod'],
            ['name' => 'Поліграфічна продукція'
            ]);

        CargoType::updateOrCreate([
            'key' => 'sport_prylad'],
            ['name' => 'Спортивне приладдя та аксесуари для відпочинку'
            ]);

        CargoType::updateOrCreate([
            'key' => 'naft_prod'],
            ['name' => 'Нафтопродукти ADR'
            ]);

        CargoType::updateOrCreate([
            'key' => 'material_synt'],
            ['name' => 'Матеріали штучного походження(синтетичні, гумові, пластмасові)'
            ]);

        CargoType::updateOrCreate([
            'key' => 'vyroby_zi_skla'],
            ['name' => 'Вироби зі скла, фарфору, кераміки та інший крихкий вантаж'
            ]);

        CargoType::updateOrCreate([
            'key' => 'elektronika'],
            ['name' => 'Електротехніка, деталі до електричних приладів, аксесуари'
            ]);

        CargoType::updateOrCreate([
            'key' => 'mebli'],
            ['name' => 'Меблі'
            ]);

        CargoType::updateOrCreate([
            'key' => 'pryrodna_s'],
            ['name' => 'Природна сировина'
            ]);

        CargoType::updateOrCreate([
            'key' => 'tsinni_mat'],
            ['name' => 'Цінні матеріали'
            ]);

        CargoType::updateOrCreate([
            'key' => 'other'],
            ['name' => 'Інші види вантажів, не віднесені до попередніх угруповань'
            ]);

        CargoType::updateOrCreate([
            'key' => 'raw'],
            ['name' => 'Сировина'
            ]);
    }
}
