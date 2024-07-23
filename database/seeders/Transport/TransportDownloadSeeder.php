<?php

namespace Database\Seeders\Transport;

use App\Models\TransportDownload;
use Illuminate\Database\Seeder;

class TransportDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportDownload::updateOrCreate([
            'key' => 'method1',
            'name' => 'Method1'
        ]);
        TransportDownload::updateOrCreate([
            'key' => 'method2',
            'name' => 'Method2'
        ]);
        TransportDownload::updateOrCreate([
            'key' => 'method3',
            'name' => 'Method3'
        ]);
        TransportDownload::updateOrCreate([
            'key' => 'method4',
            'name' => 'Method4'
        ]);
    }
}
