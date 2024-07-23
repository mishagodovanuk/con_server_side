<?php

namespace App\Http\Controllers;

use App\Http\Requests\Container\ContainerCreateUpdateRequest;
use App\Http\Resources\ContainerResource;
use App\Models\Company;
use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Workspace;
use App\Services\Container\TableFacade;

class ContainerController extends Controller
{
    public function index()
    {
        $container = Container::all();
        return view('container.index', compact('container'));
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function store(ContainerCreateUpdateRequest $request)
    {
        $data = $request->except(['_token']);
        $data['workspace_id'] = $request->user()->current_workspace_id;

        $containerId = Container::create($data);

        return response()->json(['container_id' => $containerId]);
    }

    public function create()
    {
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $containerTypes = ContainerType::all();

        return view('container.create', compact('companies', 'containerTypes'));
    }

    public function edit(Container $container)
    {
        $companies = Company::whereHas('companiesInWorkspace', function ($query) {
            $query->where('workspace_id', Workspace::current());
        })->orWhere('workspace_id', Workspace::current())->get();
        $containerTypes = ContainerType::all();

        return view('container.edit', compact('container', 'companies', 'containerTypes'));
    }

    public function update(ContainerCreateUpdateRequest $request, Container $container)
    {
        $container->fill($request->except(['_token']));
        $container->save();

        return response()->json(['container_id' => $container->id]);
    }

    public function show(Container $container)
    {
        $container->load('company.company', 'type');

        return view('container.full-info', compact('container'));
    }

    public function getContainersByType($id)
    {
        $container = Container::where('type_id', $id)->get();

        return ContainerResource::collection($container);
    }

    public function getAllData(Container $container)
    {
        return response()->json($container->getAllData());
    }
}
