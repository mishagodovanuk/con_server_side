<?php

namespace App\Services\Matches\Upload\TN;


use App\Models\Document;
use App\Models\TransportPlanning;
use App\Models\Warehouse;
use App\Services\Table\TableFilter;
use Illuminate\Support\Facades\DB;

class TableFacade
{

    public static function getFilteredData()
    {
        $dataFields = (new TransportPlanning())->getFieldsByType('tovarna_nakladna');
        $relationFields = [];
        $currentFilter = $_GET['tab'];

        $transportPlanning = TransportPlanning::find($_GET['transportPlanningId']);

        $documents = $transportPlanning->documents;
        $tnCount = count($documents);

        $startPoint = Warehouse::find($documents[0]->data()['header_ids'][$dataFields['loadingWarehouseField']. '_id']);
        $endPoint = Warehouse::find($documents[$tnCount - 1]->data()['header_ids'][$dataFields['unloadingWarehouseField']. '_id']);

        $documents = Document::
            leftJoin('document_types', 'documents.type_id', '=', 'document_types.id')
            ->leftJoin('transport_planning_documents', 'documents.id', '=', 'transport_planning_documents.document_id')
            ->leftJoin('warehouses as warehouse1', 'warehouse1.id', '=',
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(documents.data, '$.header_ids.\"{$dataFields['loadingWarehouseField']}_id\"'))"))
            ->leftJoin('warehouses as warehouse2', 'warehouse2.id', '=',
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(documents.data, '$.header_ids.\"{$dataFields['unloadingWarehouseField']}_id\"'))"))
            ->leftJoin('address_details as address_details1', 'warehouse1.address_id', '=', 'address_details1.id')
            ->leftJoin('settlements as settlements1', 'address_details1.settlement_id', '=', 'settlements1.id')
            ->leftJoin('address_details as address_details2', 'warehouse1.address_id', '=', 'address_details2.id')
            ->leftJoin('settlements as settlements2', 'address_details2.settlement_id', '=', 'settlements2.id')
            ->whereNull('transport_planning_documents.document_id')
            ->where('document_types.key', 'tovarna_nakladna')
            ->select(
                'document_types.key',
                'warehouse1.*',
                'warehouse2.*',
                'address_details1.*',
                'settlements1.*',
                'address_details2.*',
                'settlements2.*',
                'documents.*',
            );

        switch ($currentFilter) {
            case 'common_trip':

                break;

            case 'start_point':

                break;

            case 'end_point':

                break;
        }


        $formatTable = new FormatTableData();
        $tableSort = new TableSort($formatTable);
        $filter = new TableFilter($tableSort, $formatTable);
        return $filter->filter($relationFields, $documents);
    }
}
