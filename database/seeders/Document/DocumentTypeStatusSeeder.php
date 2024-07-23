<?php

namespace Database\Seeders\Document;

use App\Models\DoctypeStatus;
use Illuminate\Database\Seeder;

class DocumentTypeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctypeStatus::updateOrCreate([
           'key' => 'archieve',
           'name' => 'Архів'
        ]);

        DoctypeStatus::updateOrCreate([
            'key' => 'system',
            'name' => 'Системний'
        ]);

        DoctypeStatus::updateOrCreate([
            'key' => 'draft',
            'name' => 'Чернетка'
        ]);
    }
}
