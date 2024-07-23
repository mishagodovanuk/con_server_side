<?php

namespace Database\Seeders\Transport;

use App\Models\TransportCategory;
use Illuminate\Database\Seeder;

class TransportCategorySeeder extends Seeder
{
    public $items = [
        ['name' => 'Вантажівка', 'key' => 'lorry'],
        ['name' => 'Вантажівка з причіпом', 'key' => 'lorry_with_trailer'],
        ['name' => 'Тягач', 'key' => 'truck_tractor'],
        ['name' => 'Бус', 'key' => 'van'],
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
            TransportCategory::updateOrCreate(
                ['key' => $item['key']],
                ['name' => $item['name']]
            );
        }
    }
}
