<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\User;
use App\Services\ParseXML\Parser;
use App\Services\ParseXML\ParseSettlements;
use App\Services\Raben\Raben;

class TestController extends Controller
{
    public function test()
    {
        auth()->user()->workingData->assignRole('super_admin');
        dd(auth()->user()->workingData->role[0]->title);
    }
}
