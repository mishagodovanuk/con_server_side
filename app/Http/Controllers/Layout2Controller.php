<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Layout2Controller extends Controller
{
    public function index()
    {
        return view('warehouse.row.index');
    }
}
