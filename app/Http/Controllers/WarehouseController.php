<?php

namespace App\Http\Controllers;

use App\Http\Requests\Warehouse\MainDataRequest;
use App\Http\Requests\Warehouse\WarehouseRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\ExceptionType;
use App\Models\Schedule;
use App\Models\SchedulePattern;
use App\Models\Settlement;
use App\Models\Street;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseERP;
use App\Models\WarehouseType;
use App\Models\Workspace;
use App\Services\Warehouse\TableFacade;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{

    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.index', compact('warehouses'));
    }


    public function create()
    {
        $patterns = SchedulePattern::where('type', 'warehouse')
            ->where('workspace_id', Workspace::current())->get();

        $countries = Country::all();
        $users = User::whereHas('usersInWorkspace', function ($q) {
            $q->where('workspace_id', Workspace::current());
        })->get(['id', 'name', 'surname', 'patronymic']);

        $companies = Company::whereHas('workspace', function ($query) {
            $query->where('id', Workspace::current());
        })->get();
        $types = WarehouseType::all();
        $exceptions = ExceptionType::all();
        $warehouses = WarehouseERP::all();
        return view('warehouse.create', compact('countries', 'users', 'companies', 'types', 'exceptions', 'patterns', 'warehouses'));
    }


    public function store(WarehouseRequest $request)
    {
        Warehouse::store($request);
        return response('OK');
    }


    public function show(Warehouse $warehouse)
    {
        $exceptions = ExceptionType::all();
        return view('warehouse.revision', compact('warehouse', 'exceptions'));
    }


    public function edit(Warehouse $warehouse)
    {
        $patterns = SchedulePattern::where('type', 'warehouse')
            ->where('workspace_id', Workspace::current())->get();

        $countries = Country::all();
        $users = User::whereHas('usersInWorkspace', function ($q) {
            $q->where('workspace_id', Workspace::current());
        })->get(['id', 'name', 'surname', 'patronymic']);

        $companies = Company::whereHas('workspace', function ($query) {
            $query->where('id', Workspace::current());
        })->get();
        $types = WarehouseType::all();
        $exceptions = ExceptionType::all();
        $warehouses = WarehouseERP::all();

        return view('warehouse.data-edit', compact('warehouse', 'countries', 'users', 'companies', 'types', 'exceptions', 'patterns', 'warehouses'));
    }

    public function update(MainDataRequest $request, Warehouse $warehouse)
    {
        $warehouse->updateMainData($request);
        return response('OK');
    }

    public function editSchedule(Warehouse $warehouse)
    {
        $exceptions = ExceptionType::all();
        return view('warehouse.schedule-edit', compact('warehouse', 'exceptions'));
    }

    public function updateSchedule(Request $request, Warehouse $warehouse)
    {
        $schedule = json_decode($request->graphic, true);
        $conditions = json_decode($request->conditions, true);
        $warehouse->updateConditions($conditions);
        Schedule::where('warehouse_id', $warehouse->id)->delete();
        Schedule::store($schedule, warehouseId: $warehouse->id);

        return response('OK');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();
        return response('OK');
    }

    public function getCoordinates(Warehouse $warehouse)
    {
        return response()->json($warehouse->coordinates);
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }
}
