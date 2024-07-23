<?php

namespace Database\Seeders\Company;

use App\Models\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyType::updateOrCreate([
            'key' => 'physical',
            'short_name' => 'Фіз. особа',
            'name' => 'Фізична особа'
        ]);
        CompanyType::updateOrCreate([
            'key' => 'legal',
            'short_name' => 'Юр. особа',
            'name' => 'Юридична особа'
        ]);
    }
}
