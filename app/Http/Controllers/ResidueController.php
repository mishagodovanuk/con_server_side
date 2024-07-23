<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidueController extends Controller
{
    public function index()
    {
        return view('residue-control.index');
    }

    public function create()
    {
        return view('residue-control.create');
    }

    public function catalog()
    {
        return view('residue-control.catalogue');
    }

}
