<?php

namespace App\Services\Invoice;

use App\Http\Resources\TableCollectionResource;
use App\Services\Table\AbstractFormatTableData;
use App\Traits\InvoiceDataTrait;
use Illuminate\Support\Facades\DB;

class FormatTableData extends AbstractFormatTableData
{
    use InvoiceDataTrait;

    public function formatData($invoices)
    {
        $invoiceArr = [];
        for ($i = 0; $i < count($invoices); $i++) {
            $invoiceArr[] = $invoices[$i]->toArray();

            $invoiceArr[$i]['number'] = $invoices[$i]->category->name;

            $invoiceArr[$i]['inputOutput'] = $this->getType($invoices[$i]);
            $invoiceArr[$i]['performer'] = $invoices[$i]->company_provider->name;
            $invoiceArr[$i]['receiver'] = $invoices[$i]->company_customer->name;
            $invoiceArr[$i]['date'] = $invoices[$i]->invoice_at;
            $invoiceArr[$i]['sum'] = $invoices[$i]->sum;

            $invoiceArr[$i]['status'] = $this->getStatusName($invoices[$i]);
        }

        return TableCollectionResource::make(array_values($invoiceArr))->setTotal($invoices->total());
    }
}
