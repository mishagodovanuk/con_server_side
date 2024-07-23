<?php

namespace Database\Seeders\TransportPlanning;

use App\Models\ServiceCategories;
use App\Models\TransportPlanningFailureType;
use App\Models\TransportPlanningStatus;
use Illuminate\Database\Seeder;

class TransportPlanningFailureStatusesSeeder extends Seeder
{
    public $items = [
        ['name' => 'Failure 1', 'key' => 'failure_1'],
        ['name' => 'Failure 2', 'key' => 'failure_2'],
        ['name' => 'Failure 3', 'key' => 'failure_3'],
        ['name' => 'Failure 4', 'key' => 'failure_4'],
        ['name' => 'Failure 5', 'key' => 'failure_5'],
        ['name' => 'Failure 6', 'key' => 'failure_6'],
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
            TransportPlanningFailureType::updateOrCreate(
                ['key' => $item['key']],
                ['name' => $item['name']]
            );
        }
    }
}
