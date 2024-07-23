<?php

namespace Database\Seeders\Transport;

use App\Models\DownloadZone;
use Illuminate\Database\Seeder;

class DownloadZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DownloadZone::updateOrCreate(['key'=>'A', 'name'=>'A']);
        DownloadZone::updateOrCreate(['key'=>'B', 'name'=>'B']);
        DownloadZone::updateOrCreate(['key'=>'C', 'name'=>'C']);
        DownloadZone::updateOrCreate(['key'=>'D', 'name'=>'D']);
        DownloadZone::updateOrCreate(['key'=>'E', 'name'=>'E']);

    }
}
