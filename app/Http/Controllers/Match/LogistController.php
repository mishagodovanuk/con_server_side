<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class LogistController extends Controller
{
    public function showLogistic()
    {
        return view('match.logist.pages.pending-review');
    }
    public function confirmed()
    {
        return view('match.logist.pages.confirmed');
    }

    public function pendinReview()
    {
        return view('match.logist.pages.pending-review');
    }

    public function progress()
    {
        return view('match.logist.pages.progress');
    }

    public function rejected()
    {
        return view('match.logist.pages.rejected');
    }

}

