<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Enums\InvoiceStatus;

trait InvoiceDataTrait
{
    public function getType($invoice)
    {
        if ($invoice->workspace_id == Auth::user()->current_workspace_id) {
            return 'Вихідний';
        } else {
            return 'Вхідний';
        }
    }

    public function getStatusName($invoice)
    {
        switch ($invoice->status_id)
        {
            case (InvoiceStatus::PENDING_OF_PAY->value):
                if ($invoice->workspace_id == Auth::user()->current_workspace_id) {
                    return 'Очікує на оплату контрагентом';
                } else {
                    return 'Очікує на вашу оплату';
                }
            case (InvoiceStatus::PAYED->value):
                if ($invoice->workspace_id == Auth::user()->current_workspace_id) {
                    return 'Оплачено контрагентом';
                } else {
                    return 'Оплачено вами';
                }
            case (InvoiceStatus::REJECTED->value):
                if ($invoice->workspace_id == Auth::user()->current_workspace_id) {
                    return 'Відхилено контрагентом';
                } else {
                    return 'Відхилено вами';
                }
            default:
                return '';
        }
    }
}
