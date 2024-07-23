<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaterkitController extends Controller
{

    // without menu
    public function without_menu()
    {
        $pageConfigs = ['showMenu' => false];

        return view('/content/layout-without-menu', ['pageConfigs' => $pageConfigs]);
    }

}
