<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransportPlanning\AddFailureRequest;
use App\Http\Requests\TransportPlanning\DestroyStatusRequest;
use App\Http\Requests\TransportPlanning\DestroyTransportPlanningRequest;
use App\Http\Requests\TransportPlanning\StoreStatusRequest;
use App\Http\Requests\TransportPlanning\UpdateStatusRequest;
use App\Models\AdditionalEquipment;
use App\Models\AddressDetails;
use App\Models\Company;
use App\Models\Document;
use App\Models\Transport;
use App\Models\TransportPlanning;
use App\Models\TransportPlanningFailure;
use App\Models\TransportPlanningFailureType;
use App\Models\TransportPlanningStatus;
use App\Models\TransportPlanningToStatus;
use App\Models\User;
use App\Models\Workspace;
use App\Services\TransportPlaning\TableFacade;
use App\Services\GoodsInvoices\TableFacade as GoodsTableFacade;
use App\Services\GoodsInvoicesByPlanning\TableFacade as GoodsByPlanningTableFacade;
use App\Services\TransportRequest\TableFacade as TransportRequestFacade;
use App\Services\TransportPlaning\TransportRequestByPlanning\TableFacade as TransportRequestByPlanningFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransportPlanningController extends Controller
{
    public function index()
    {
        $transportPlanning = TransportPlanning::all();
        return view('transport-planning.days-list', compact('transportPlanning'));
    }

    public function create()
    {
        $currentWorkspaceId = Auth::user()->current_workspace_id;

        $companies = Company::where('workspace_id', $currentWorkspaceId)
            ->get([
                'id',
                DB::raw("CASE
                    WHEN companies.company_type_id = 1 THEN (SELECT CONCAT(physical_companies.first_name, ' ', physical_companies.surname) FROM physical_companies WHERE physical_companies.id = companies.company_id)
                    ELSE (SELECT name FROM legal_companies WHERE legal_companies.id = companies.company_id)
                END as name")
            ]);

        $transports = Transport::with(['brand', 'model'])->where('workspace_id', Workspace::current())->get();
        $additionalEquipments = AdditionalEquipment::with(['brand', 'model'])
            ->where('workspace_id', Workspace::current())->get();
        $drivers = User::get(['id', 'name', 'surname']);

        return view('transport-planning.create-of-TP',
            compact('companies', 'transports', 'additionalEquipments', 'drivers')
        );
    }

    public function store(Request $request)
    {
        $transportPlanningId = TransportPlanning::store($request);

        return response()->json(['transport_planning_id' => $transportPlanningId]);
    }

    public function getDocuments()
    {
        $documents = Document::whereHas('documentType', function ($q) {
            $q->where('name', 'Товарна накладна');
        })->get();

        return response()->json(['documents' => $documents]);
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function transportRequestFilter()
    {
        return TransportRequestFacade::getFilteredData();
    }

    public function show(TransportPlanning $transportPlanning)
    {
        $planning = (new TransportPlanning())->getItem($transportPlanning->id);

        $allStatuses = TransportPlanningStatus::all();
        $allAddresses = AddressDetails::addFullAddress()->get();
        $allFailureTypes = TransportPlanningFailureType::all();

        return view('transport-planning.tn-details',
            compact('planning', 'allStatuses', 'allAddresses', 'allFailureTypes')
        );
    }

    public function destroy(DestroyTransportPlanningRequest $request, TransportPlanning $transportPlanning)
    {
        $transportPlanning->delete();

        return response()->json('Successful destroy');
    }

    public function listByDate($date)
    {
        $transportPlannings = (new TransportPlanning)->getByDate($date);
        $allStatuses = TransportPlanningStatus::all();
        $allAddresses = AddressDetails::addFullAddress()->get();
        $allFailureTypes = TransportPlanningFailureType::all();

        return view(
            'transport-planning.planning-list',
            compact('transportPlannings', 'date', 'allStatuses', 'allAddresses', 'allFailureTypes')
        );
    }

    public function goodsInvoicesFilter()
    {
        return GoodsTableFacade::getFilteredData();
    }

    public function goodsInvoicesByPlanningFilter($id)
    {
        return GoodsByPlanningTableFacade::getFilteredData($id);
    }

    public function updateStatus(UpdateStatusRequest $request, TransportPlanningToStatus $status)
    {
        $data = $request->except(['_token']);

        $status->fill($data);
        $status->save();

        return response()->json(['status_id' => $status->id]);
    }

    public function addStatus(StoreStatusRequest $request)
    {
        $data = $request->except(['_token']);

        $status = TransportPlanningToStatus::create($data);

        return response()->json(['status_id' => $status->id]);
    }

    public function deleteStatus(DestroyStatusRequest $request, TransportPlanningToStatus $status)
    {
        $status->delete();

        return response()->json('Successful destroy');
    }

    public function addFailure(AddFailureRequest $request, TransportPlanningToStatus $status)
    {
        $data = $request->except(['_token']);

        $failureId = TransportPlanningFailure::updateOrCreate(['status_id' => $status->id], $data);

        return response()->json(['failure_id' => $failureId]);
    }

    public function transportRequestByPlanningFilter($id)
    {
        return TransportRequestByPlanningFacade::getFilteredData($id);
    }
}
