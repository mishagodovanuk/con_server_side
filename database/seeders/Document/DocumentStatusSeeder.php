<?php

namespace Database\Seeders\Document;

use App\Models\DocumentStatus;
use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentStatus::updateOrCreate([
            'key'=> 'created',
            'name' => 'Створено'
        ]);
        DocumentStatus::updateOrCreate([
            'key'=> 'draft',
            'name' => 'Збрежено як чернетку'
        ]);
        DocumentStatus::updateOrCreate([
           'key'=> 'provided',
            'name' => 'Проведено через WMS'
        ]);
    }
}
