<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transport\EquipmentRequest;
use App\Http\Resources\AdditionalEquipmentModelResource;
use App\Interfaces\StoreImageInterface;
use App\Models\AdditionalEquipment;
use App\Models\AdditionalEquipmentBrand;
use App\Models\AdditionalEquipmentModel;
use App\Models\Adr;
use App\Models\Company;
use App\Models\Country;
use App\Models\Transport;
use App\Models\TransportDownload;
use App\Models\TransportType;
use App\Models\Workspace;
use App\Services\AdditionalEquipment\TableFacade;

class TransportEquipmentController extends Controller
{

    public function index()
    {
        $additionalEquipments = AdditionalEquipment::all(
            ['id', 'brand_id', 'model_id', 'type_id', 'license_plate', 'download_methods', 'company_id', 'transport_id']);
        return view('additional-equipment.index', compact('additionalEquipments'));
    }

    public function create()
    {
        $types = TransportType::all();

        $brands = AdditionalEquipmentBrand::all();
        $models = AdditionalEquipmentModel::all();
        $countries = Country::all();
        $download_methods = TransportDownload::all();
        $companies = Company::whereHas('workspace', function ($query) {
            $query->where('id', Workspace::current());
        })->get();
        $transports = Transport::where('workspace_id', Workspace::current())
            ->get(['id', 'brand_id', 'model_id']);
        $adrs = Adr::all();
        return view('additional-equipment.create', compact('types', 'companies',
            'brands', 'models', 'countries', 'download_methods', 'transports', 'adrs'));
    }

    public function store(EquipmentRequest $request)
    {
        AdditionalEquipment::store($request);
        return response('OK');
    }

    public function show(AdditionalEquipment $transportEquipment)
    {
        return view('additional-equipment.profile', compact('transportEquipment'));
    }

    public function edit(AdditionalEquipment $transportEquipment)
    {
        $types = TransportType::all();
        $brands = AdditionalEquipmentBrand::all();
        $models = AdditionalEquipmentModel::all();
        $countries = Country::all();
        $download_methods = TransportDownload::all();
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $transports = Transport::where('workspace_id', Workspace::current())
            ->get(['id', 'brand_id', 'model_id']);
        $adrs = Adr::all();
        return view('additional-equipment.edit', compact('types', 'companies',
            'brands', 'models', 'countries', 'download_methods', 'transports', 'adrs', 'transportEquipment'));
    }

    public function update(EquipmentRequest $request, AdditionalEquipment $transportEquipment)
    {
        $transportEquipment->edit($request);
        return response('OK');
    }

    public function destroy(AdditionalEquipment $transportEquipment, StoreImageInterface $image)
    {
        $transportEquipment->delete();
        $image->deleteImage($transportEquipment, 'transport-equipment');
        return redirect()->route('transport-equipment.index');
    }

    public function deleteImage(AdditionalEquipment $transportEquipment, StoreImageInterface $image)
    {
        $image->deleteImage($transportEquipment, 'transport-equipment');
        return redirect()->back();
    }

    public function getModelByBrand(AdditionalEquipmentBrand $additionalEquipmentBrand)
    {
        return AdditionalEquipmentModelResource::collection($additionalEquipmentBrand->models);
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }
}
