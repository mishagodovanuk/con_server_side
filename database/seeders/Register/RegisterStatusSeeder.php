<?php

namespace Database\Seeders\Register;

use App\Models\RegisterStatus;
use Illuminate\Database\Seeder;

class RegisterStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegisterStatus::updateOrCreate([
            'key'=>'create',
            'name' => 'Створено'
        ]);
        RegisterStatus::updateOrCreate([
            'key'=>'register',
            'name' => 'Зареєстровано'
        ]);
        RegisterStatus::updateOrCreate([
            'key'=>'apply',
            'name' => 'Підтверджено'
        ]);
        RegisterStatus::updateOrCreate([
            'key'=>'launch',
            'name' => 'Запущено'
        ]);
        RegisterStatus::updateOrCreate([
            'key'=>'release',
            'name' => 'Поза територією'
        ]);
    }
}
