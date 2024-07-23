<?php

namespace App\Http\Controllers;

use App\Events\RegistersChangedStatus;
use App\Http\Requests\Registers\RegisterRequest;
use App\Http\Resources\RegisterResurce;
use App\Http\Resources\UserResource;
use App\Models\DownloadZone;
use App\Models\Register;
use App\Models\TransportDownload;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\Registers\PaginationPage;
use App\Services\Registers\TableFacade;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function guardian()
    {
        $storekeepers = User::all(['id', 'surname', 'name']);
        $warehouses = Warehouse::currentWorkspace()->get(['id', 'name']);

        return view('registers.guardian', ['storekeepers' => UserResource::collection($storekeepers), 'warehouses' => $warehouses]);
    }

    public function storekeeper()
    {
        $storekeepers = User::all(['id', 'surname', 'name']);
        $managers = User::all(['id', 'surname', 'name']);
        $downloadZone = DownloadZone::all();
        $transportDownload = TransportDownload::all();
        $warehouses = Warehouse::currentWorkspace()->get(['id', 'name']);

        return view('registers.storekeeper', [
            'storekeepers' => UserResource::collection($storekeepers),
            'managers' => UserResource::collection($managers), 'downloadZone' => RegisterResurce::collection($downloadZone),
            'transportDownload' => RegisterResurce::collection($transportDownload),
            'warehouses' => $warehouses
        ]);
    }

    public function filter(Request $request)
    {
        return TableFacade::getFilteredData($request->get('warehouses_ids'));
    }

    public function create()
    {
        return view('registers.create');
    }

    public function store(Request $request)
    {

        for($i=0;$i<100;$i++) {
            $register = Register::create([
                'auto_name' => $request->auto_name,
                'time_arrival' => $request->arrive,
                'status_id' => 1
            ]);
        }
        broadcast(new RegistersChangedStatus($register->fresh()));

        return redirect()->back();
    }


    public function delete(Register $register)
    {
        $register->delete();
        return response('ok');
    }

    public function update(RegisterRequest $request, Register $register)
    {
        $register->updateWithRelations($request->validated());
        return response('ok');
    }

    public function getStorekeepers()
    {
        return UserResource::collection(User::all(['id', 'surname', 'name']));
    }

    public function getManagers()
    {
        return UserResource::collection(User::all(['id', 'surname', 'name']));
    }

    public function getPageByRegister(Request $request, PaginationPage $pager)
    {
        return response()->json(['page' =>
            $pager->getPageByRegisterId($request->id, $request->pager_rows, $request->sort)]);
    }

}
