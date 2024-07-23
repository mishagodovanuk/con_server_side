<?php

namespace Database\Seeders\Common;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate([
            'key' => 'ukraine',
            'name' => 'Україна'
        ]);
        Country::updateOrCreate([
            'key' => 'usa',
            'name' => 'Сполучені Штати Америки'
        ]);
        Country::updateOrCreate([
            'key' => 'england',
            'name' => 'Англія'
        ]);
        Country::updateOrCreate([
            'key' => 'poland',
            'name' => 'Польща'
        ]);
        Country::updateOrCreate([
            'key' => 'germany',
            'name' => 'Німеччина'
        ]);
    }
}
