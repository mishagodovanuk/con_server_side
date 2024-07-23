<?php

namespace Database\Seeders\User;

use App\Models\ExceptionType;
use Illuminate\Database\Seeder;

class ExceptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExceptionType::updateOrCreate([
           'key' => 'day_off',
           'name' => 'Вихідний'
        ]);
        ExceptionType::updateOrCreate([
            'key' => 'hospital',
            'name' => 'Лікарняний'
        ]);
        ExceptionType::updateOrCreate([
            'key' => 'short_day',
            'name' => 'Cкорочений день'
        ]);
        ExceptionType::updateOrCreate([
            'key' => 'holiday',
            'name' => 'Державний вихідний'
        ]);
    }
}
