<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\LegalCompanyRequest;
use App\Http\Requests\Company\PhysicalCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Interfaces\StoreFileInterface;
use App\Models\Company;
use App\Models\CompanyToWorkspace;
use App\Models\Country;
use App\Models\FileLoad;
use App\Models\LegalType;


use App\Models\Workspace;
use App\Services\Company\CompanyFilter;
use App\Services\Company\TableFacade;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *

     */
    public function index()
    {
        $companiesAll = Company::all();
        $companies = Company::with('company')->get();
        return view('company.index', compact("companies", 'companiesAll'));
    }

    /**
     * Show the form for creating a new resource.
     *

     */
    public function create()
    {
        $countries = Country::all();
        $legalTypes = LegalType::all();
        return view('company.create', compact('countries', 'legalTypes'));
    }


    public function storeLegalCompany(LegalCompanyRequest $request)
    {
        $company = Company::createLegal($request);

        return response()->json($company->toArray());
    }

    public function storePhysicalCompany(PhysicalCompanyRequest $request)
    {
        $company = Company::createPhysical($request);

        return response()->json($company->toArray());
    }


    public function show(Company $company)
    {
        $dataArray['company'] = $company;

        if ($company->company_type_id == 2) {
            $dataArray['registerFile'] = FileLoad::where('path', 'company/docs/registration')
                ->where('new_name', $company->company->id . '.' . $company->company->reg_doctype)
                ->where('workspace_id', Workspace::current())->first();

            $dataArray['installFile'] = FileLoad::where('path', 'company/docs/install')
                ->where('new_name', $company->company->id . '.' . $company->company->install_doctype)
                ->where('workspace_id', Workspace::current())->first();
        }

        return view('company.company-info', $dataArray);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     */
    public function edit(Company $company)
    {
        $countries = Country::all();

        if ($company->type->key == 'physical') {
            return view('company.edit-physical', compact('company', 'countries'));
        } else {
            $legalTypes = LegalType::all();
            return view('company.edit-legal', compact('company', 'countries', 'legalTypes'));
        }
    }

    public function updateLegalCompany(LegalCompanyRequest $request, Company $company)
    {
        $company->updateLegal($request);

        return redirect()->back();
    }

    public function updatePhysicalCompany(PhysicalCompanyRequest $request, Company $company)
    {
        $company->updatePhysical($request);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return response('OK');
    }

    public function removeImage(Company $company, StoreFileInterface $image)
    {
        $image->deleteFile('company/image', $company, 'img_type');
        return response('OK');
    }

    public function find(CompanyFilter $filter)
    {
        $query = $_GET['query'];
        $country = $_GET['country'];
        $company = $filter->find($query, $country);

        if ($company && !$company->isEmpty()) {
            return CompanyResource::make($company);
        }

        return response()->json(['message' => 'Company not found'], 404);
    }

    public function addCompanyToWorkspace(Company $company, Request $request)
    {
        CompanyToWorkspace::firstOrCreate([
            'company_id' => $company->id,
            'workspace_id' => Workspace::current()
        ]);

        return response('OK');
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }
}
