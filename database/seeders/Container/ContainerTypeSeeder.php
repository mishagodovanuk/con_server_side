<?php

namespace Database\Seeders\Container;

use App\Models\ContainerType;
use Illuminate\Database\Seeder;

class ContainerTypeSeeder extends Seeder
{
    public $items = [
        ['name' => 'Тип 1', 'key' => 'type_1'],
        ['name' => 'Тип 2', 'key' => 'type_2'],
        ['name' => 'Тип 3', 'key' => 'type_3'],
        ['name' => 'Тип 4', 'key' => 'type_4'],
        ['name' => 'Тип 5', 'key' => 'type_5'],
        ['name' => 'Тип 6', 'key' => 'type_6'],
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
            ContainerType::updateOrCreate(
                ['key' => $item['key']],
                ['name' => $item['name']]
            );
        }
    }
}
