<?php

namespace App\Http\Controllers;


use App\Services\Transport\TableFacade;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoice.index');
    }

    public function create()
    {
        return view('invoice.invoicing');
    }

    public function show()
    {
        return view('invoice.view');
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function obligations_filter()
    {
        return TableFacade::getFilteredData();
    }

}
