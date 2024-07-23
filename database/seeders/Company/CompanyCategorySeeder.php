<?php

namespace Database\Seeders\Company;

use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyCategory::updateOrCreate([
            'key' => 'producer',
            'name' => 'Виробник'
        ]);

        CompanyCategory::updateOrCreate([
            'key' => 'provider',
            'name' => 'Постачальник'
        ]);

        CompanyCategory::updateOrCreate([
            'key' => 'distributor',
            'name' => 'Дистрибютор'
        ]);

        CompanyCategory::updateOrCreate([
            'key' => 'supermarket',
            'name' => 'Супермаркет'
        ]);

        CompanyCategory::updateOrCreate([
            'key' => 'carrier',
            'name' => 'Перевізник'
        ]);
        CompanyCategory::updateOrCreate([
            'key' => '3pl',
            'name' => '3PL - оператор'
        ]);
    }
}
