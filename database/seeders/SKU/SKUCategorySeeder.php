<?php

namespace Database\Seeders\SKU;

use App\Models\SKUCategory;
use Illuminate\Database\Seeder;

class SKUCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        SKUCategory::updateOrCreate([
            'key' => 'product'],
            ['name' => 'Продукти харчування, б/а напої без дотримання температурного режиму'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'product_t'],
            ['name' => 'Продукти харчування з дотриманням температурного режиму'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'pobut'],
            ['name' => 'Побутові та господарські товари'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'vydub_prom'],
            ['name' => 'Продукція видобувної промисловості'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'textile'],
            ['name' => 'Текстильні товари'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'bud_material'],
            ['name' => 'Будівельні матеріали, інструменти, сировина для будівництва, сантехніка'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'poligraph_prod'],
            ['name' => 'Поліграфічна продукція'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'sport_prylad'],
            ['name' => 'Спортивне приладдя та аксесуари для відпочинку'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'naft_prod'],
            ['name' => 'Нафтопродукти ADR'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'material_synt'],
            ['name' => 'Матеріали штучного походження(синтетичні, гумові, пластмасові)'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'vyroby_zi_skla'],
            ['name' => 'Вироби зі скла, фарфору, кераміки та інший крихкий вантаж'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'elektronika'],
            ['name' => 'Електротехніка, деталі до електричних приладів, аксесуари'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'mebli'],
            ['name' => 'Меблі'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'pryrodna_s'],
            ['name' => 'Природна сировина'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'tsinni_mat'],
            ['name' => 'Цінні матеріали'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'other'],
            ['name' => 'Інші види вантажів, не віднесені до попередніх угруповань'
            ]);

        SKUCategory::updateOrCreate([
            'key' => 'raw'],
            ['name' => 'Сировина'
            ]);
    }
}
