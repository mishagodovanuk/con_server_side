<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Integration extends Model
{
    protected $guarded = [];

    public static function store($request)
    {
        $data = $request->except(['_token']);

        $data['key'] = Str::random(60);

        $integration = Integration::create($data);

        return $integration->id;
    }
}
