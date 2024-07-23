<?php

namespace App\Services\Invoice;

use App\Models\Goods;
use App\Models\Invoice;
use App\Services\Table\TableFilter;

class TableFacade
{
    public static function getFilteredData(){
        $relationFields = [
            'company_provider' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'company_customer' => function ($q) {
                $q->select('companies.id')->addName();
            },
        ];
        $invoices = Invoice::with($relationFields);

        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort,$formatTable);
        return $filter->filter($relationFields,$invoices);
    }
}
