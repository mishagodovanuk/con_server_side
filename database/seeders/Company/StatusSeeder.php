<?php

namespace Database\Seeders\Company;

use App\Models\CompanyStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyStatus::updateOrCreate([
            'key' => 'to_accept',
            'name' => 'Компанія на розгляді'
        ]);
        CompanyStatus::updateOrCreate([
            'key' => 'accepted',
            'name' => 'Прийнята компанія'
        ]);
        CompanyStatus::updateOrCreate([
            'key' => 'rejected',
            'name' => 'Відхилена компанія'
        ]);
    }
}
