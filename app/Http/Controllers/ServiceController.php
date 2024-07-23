<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategories;
use App\Models\Workspace;
use App\Services\Service\TableFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceController extends Controller
{
    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function store(Request $request)
    {
        $dataArray = $request->except(['_token']);
        $dataArray['workspace_id'] = Workspace::current();
        $serviceId = Service::create($dataArray);

        return response()->json(['service_id' => $serviceId]);
    }

    public function update(Request $request, Service $service)
    {
        $service->fill($request->except(['_token']));
        $service->save();

        return response()->json(['service_id' => $service->id]);
    }

    public function show(Service $service)
    {
        return view('service.view', compact('service'));
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategories::get();

        return view('service.edit', compact('categories', 'service'));
    }

    public function create()
    {
        $categories = ServiceCategories::get();

        return view('service.create', compact('categories'));
    }

    public function index()
    {
        $services = Service::all();

        return view('service.index', compact('services'));
    }

    public function getServicesByType($id)
    {

        $services = Service::where('category_id', $id)->get();

        return JsonResource::collection($services);
    }
}
