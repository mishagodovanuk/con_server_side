<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function store($schedule,$userId=null,$warehouseId=null){
        $scheduleArray = [];
        foreach ($schedule as $key => $day) {
            if ($day === 'holiday') {
                $scheduleArray[] = [
                    'weekday' => $key,
                    'is_day_off' => true,
                    'start_at' => null,
                    'end_at' => null,
                    'break_start_at' => null,
                    'break_end_at' => null,
                    'user_id' => $userId,
                    'warehouse_id' => $warehouseId,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ];
            } else {
                $scheduleArray[] = [
                    'weekday' => $key,
                    'is_day_off' => false,
                    'start_at' => $day[0],
                    'end_at' => $day[1],
                    'break_start_at' => $day[2],
                    'break_end_at' => $day[3],
                    'user_id' => $userId,
                    'warehouse_id' => $warehouseId,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ];
            }
        }

        Schedule::insert($scheduleArray);
    }

}
