<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Services\Matches\Upload\TP\TableFacade as UploadTableFacade;


class DispatcherController extends Controller
{
    public function showDispatcher()
    {
        return view('match.dispatcher.pages.top-up');
    }

    public function jointFtl()
    {
        return view('match.dispatcher.pages.joint-ftl');
    }

    public function largerTransport()
    {
        return view('match.dispatcher.pages.lg-transport');
    }

    public function reverseLoading()
    {
        return view('match.dispatcher.pages.backhaul');
    }

    public function created()
    {
        return view('match.dispatcher.pages.created');
    }

    public function draft()
    {
        return view('match.dispatcher.pages.draft');
    }

    public function filter()
    {
        return UploadTableFacade::getFilteredData();
    }
}
