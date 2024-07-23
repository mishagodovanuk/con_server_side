<?php

namespace Database\Seeders\Service;

use App\Models\ServiceCategories;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public $items = [
        ['name' => 'Прийом товару', 'key' => 'pryiom_tovaru'],
        ['name' => 'Зберігання товару', 'key' => 'zberihannia_tovaru'],
        ['name' => 'Відвантаження товару', 'key' => 'vidvantazhennia_tovaru'],
        ['name' => 'Комплектація товару', 'key' => 'komplektatsiia_tovaru'],
        ['name' => 'Стікерування товару', 'key' => 'stikeruvannia_tovaru'],
        ['name' => 'Копакінг товару', 'key' => 'kopakinh_tovaru'],
        ['name' => 'Кросдок', 'key' => 'krosdok'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->items as $item)
        {
            ServiceCategories::updateOrCreate(
                ['key' => $item['key']],
                ['name' => $item['name']]
            );
        }
    }
}
