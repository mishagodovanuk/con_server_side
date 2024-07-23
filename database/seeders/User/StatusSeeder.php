<?php

namespace Database\Seeders\User;

use App\Models\UserStatus;
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
        UserStatus::updateOrCreate([
           'key' => 'online',
           'name' => 'В системі'
        ]);
        UserStatus::updateOrCreate([
            'key' => 'on_warehouse',
            'name' => 'На складі'
        ]);
        UserStatus::updateOrCreate([
            'key' => 'offline',
            'name' => 'Офлайн'
        ]);
    }
}
