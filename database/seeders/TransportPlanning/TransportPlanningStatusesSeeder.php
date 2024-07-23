<?php

namespace Database\Seeders\TransportPlanning;

use App\Models\ServiceCategories;
use App\Models\TransportPlanningStatus;
use Illuminate\Database\Seeder;

class TransportPlanningStatusesSeeder extends Seeder
{
    public $items = [
        ['name' => 'На затвердженні ціни', 'key' => 'approval_price'],
        ['name' => 'Затверджений', 'key' => 'approved'],
        ['name' => 'До завантаження', 'key' => 'before_downloading'],
        ['name' => 'Завантажений', 'key' => 'loaded'],
        ['name' => 'В дорозі', 'key' => 'in_the_way'],
        ['name' => 'В розподільчому центрі', 'key' => 'in_the_distribution_center'],
        ['name' => 'Триває постачання', 'key' => 'delivery_in_progress'],
        ['name' => 'Доставлено', 'key' => 'delivered'],
        ['name' => 'Доставлено з затримкою', 'key' => 'delivered_with_a_delay'],
        ['name' => 'Доставлено з пошкодженням', 'key' => 'delivered_damaged'],
        ['name' => 'Оплачено', 'key' => 'paid'],
        ['name' => 'Завершити рейс', 'key' => 'end_the_trip'],
        ['name' => 'Скасувати рейс', 'key' => 'cancel_the_trip'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->items as $item)
        {
            TransportPlanningStatus::updateOrCreate(
                ['key' => $item['key']],
                ['name' => $item['name']]
            );
        }
    }
}
