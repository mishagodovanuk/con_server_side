<?php

namespace App\Http\Controllers\Match;

use App\Http\Controllers\Controller;
use App\Http\Resources\Match\GoodsInvoiceResource;
use App\Models\Document;
use App\Models\TransportPlanning;
use App\Services\Matches\Upload\TN\TableFacade;
class GoodsInvoiceController extends Controller
{
    public function getGoodsInvoicesByTransportPlanning(TransportPlanning $transportPlanning)
    {
        $documents = $transportPlanning->documents;

        return GoodsInvoiceResource::collection($documents);
    }

    public function getGoodsInvoicesInfo(Document $document)
    {
        if ($document->documentType->key === 'tovarna_nakladna') {

            return GoodsInvoiceResource::make($document);
        } else {
            abort(404);
        }
    }
    public function filter()
    {
        return TableFacade::getFilteredData();
    }
}
