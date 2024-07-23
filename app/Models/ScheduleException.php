<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleException extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function type()
    {
        return $this->hasOne(ExceptionType::class, 'id', 'type_id');
    }
}
