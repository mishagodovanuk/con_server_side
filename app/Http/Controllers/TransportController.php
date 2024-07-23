<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transport\TruckRequest;
use App\Http\Requests\Transport\TruckWithoutTrailer;
use App\Http\Resources\TransportModelResource;
use App\Interfaces\StoreImageInterface;
use App\Models\AdditionalEquipment;
use App\Models\Adr;
use App\Models\Company;
use App\Models\Country;
use App\Models\Transport;
use App\Models\TransportBrand;
use App\Models\TransportDownload;
use App\Models\TransportCategory;
use App\Models\TransportType;
use App\Models\User;
use App\Models\Workspace;
use App\Services\Transport\TableFacade;
use Illuminate\Support\Facades\DB;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::all();
        return view('transport.index', compact('transports'));
    }

    public function create()
    {
        $brands = TransportBrand::all();
        $countries = Country::all();
        $types = TransportType::all();
        $categories = TransportCategory::all();
        $download_methods = TransportDownload::all();
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $drivers = User::withWorkingData()
            ->where('user_working_data.workspace_id', Workspace::current())
            ->whereHas('workingData.position', function ($query) {
                $query->where('key', 'driver');
            })
            ->get();

        $additionalEquipments = AdditionalEquipment::where('workspace_id', Workspace::current())
            ->get(['id', 'brand_id', 'model_id']);
        $adrs = Adr::all();
        return view('transport.create',
            compact('companies', 'brands', 'countries', 'types',
                'categories', 'download_methods', 'drivers', 'additionalEquipments', 'adrs'));
    }

    public function store(TruckWithoutTrailer $request)
    {
        Transport::storeWithoutTrailer($request);
        return response('OK');
    }

    public function storeWithAdditional(TruckRequest $request)
    {
        Transport::storeWithTrailer($request);
        return response('OK');
    }

    public function show(Transport $transport)
    {
        return view('transport.profile', compact('transport'));
    }

    public function edit(Transport $transport)
    {

        $brands = TransportBrand::all();
        $countries = Country::all();
        $types = TransportType::all();
        $categories = TransportCategory::all();
        $download_methods = TransportDownload::all();
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $drivers = User::withWorkingData()
            ->where('user_working_data.workspace_id', Workspace::current())
            ->whereHas('workingData.position', function ($query) {
                $query->where('key', 'driver');
            })
            ->get();

        $additionalEquipments = AdditionalEquipment::where('workspace_id', Workspace::current())
            ->get(['id', 'brand_id', 'model_id']);
        $adrs = Adr::all();
        return view('transport.edit',
            compact('companies', 'brands', 'countries', 'types',
                'categories', 'download_methods', 'drivers', 'transport', 'additionalEquipments', 'additionalEquipments', 'adrs'));
    }

    public function deleteImage(Transport $transport, StoreImageInterface $image)
    {
        $image->deleteImage($transport, 'transport');
        return redirect()->back();
    }

    public function update(TruckWithoutTrailer $request, Transport $transport)
    {
        $transport->updateWithoutTrailer($request);
        return response('OK');
    }

    public function updateWithAdditional(TruckRequest $request, Transport $transport)
    {
        $transport->updateWithTrailer($request);
        return response('OK');
    }

    public function destroy(Transport $transport, StoreImageInterface $image)
    {
        $transport->delete();
        $image->deleteImage($transport, 'transport');

        return redirect()->route('transport.index');
    }

    public function getModelByBrand(TransportBrand $transportBrand)
    {
        return TransportModelResource::collection($transportBrand->models);
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }
}
