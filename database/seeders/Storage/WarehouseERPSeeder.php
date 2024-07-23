<?php

namespace Database\Seeders\Storage;

use App\Models\WarehouseERP;
use Illuminate\Database\Seeder;

class WarehouseERPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WarehouseERP::updateOrCreate([
            'key' => 'erp1',
            'name' => 'Erp1'
        ]);
        WarehouseERP::updateOrCreate([
            'key' => 'erp2',
            'name' => 'Erp2'
        ]);
        WarehouseERP::updateOrCreate([
            'key' => 'erp3',
            'name' => 'Erp3'
        ]);
        WarehouseERP::updateOrCreate([
            'key' => 'erp4',
            'name' => 'Erp4'
        ]);
    }
}
