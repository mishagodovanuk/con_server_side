<?php

namespace App\Http\Controllers;

use App\Http\Requests\Workspace\StoreWorkspaceRequest;
use App\Http\Requests\Workspace\UpdateWorkspaceRequest;
use App\Http\Resources\WorkspaceResource;
use App\Models\Company;
use App\Models\CompanyRequest;
use App\Models\CompanyToWorkspace;
use App\Models\Country;
use App\Models\Integration;
use App\Models\LegalType;
use App\Models\UserWorkingData;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class WorkspacesController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $userToCompanyRequests = Auth::user()->createdCompanies()->with('requests')->get()
            ->pluck('requests')
            ->flatten();


        $workspaces = Auth::user()->workspaces;

        $requests = CompanyRequest::with(['company.workspace.owner'])->where('user_id', $userId)->get();

        return view('workspaces.workspaces-list', compact('workspaces', 'requests', 'userToCompanyRequests'));
    }

    public function create()
    {
        return view('workspaces.create');
    }

    public function createCompany()
    {
        $countries = Country::all();
        $legalTypes = LegalType::all();
        return view('workspaces.create-company', compact('countries', 'legalTypes'));
    }

    public function edit(Workspace $workspace)
    {
        $usersInWorkspaceCount = $workspace->usersInWorkspace()->count();
        $companies = Company::with(['users:user_id'])
            ->where(function ($query) {
                $query->whereHas('companiesInWorkspace', function ($subQuery) {
                    $subQuery->where('workspace_id', Workspace::current());
                });
            })->orWhere('workspace_id', Workspace::current())
            ->get(['id', 'workspace_id']);


        $companiesCount = $companies->count();
        $uniqueUsersCount = $companies->pluck('users')->collapse()->unique('user_id')->count();

        $integrations = Integration::where('workspace_id', $workspace->id)->get();

        return view('workspaces.workspace-settings', compact('workspace', 'companiesCount', 'usersInWorkspaceCount', 'uniqueUsersCount', 'integrations'));
    }

    public function store(Request $request, Company $company)
    {
        $workspaceId = Workspace::store($request);
        if (!$company) {
            $company = Company::where('creator_id', Auth::id())->latest()->first();
        }
        $company->workspace_id = $workspaceId;
        $company->save();

        UserWorkingData::create([
            'company_id' => $company->id,
            'user_id' => Auth::id(),
            'workspace_id' => $workspaceId
        ]);

        CompanyToWorkspace::create([
            'company_id' => $company->id,
            'workspace_id' => $workspaceId
        ]);

        Auth::user()->update(['current_workspace_id' => $workspaceId]);

        $workingData = UserWorkingData::where('company_id', $company->id)->where('user_id', Auth::id())->first();
        $workingData->update(['workspace_id' => $workspaceId]);

        $workingData->assignRole('admin');

        return response()->json(['workspace_id' => $workspaceId]);
    }

    public function update(UpdateWorkspaceRequest $request, Workspace $workspace)
    {
        $workspace->updateData($request);

        return response()->json(['workspace_id' => $workspace->id]);
    }

    public function destroy(Workspace $document)
    {
        $document->delete();

        return response()->json([], 201);
    }

    public function getWorkspacesList()
    {
        $user = Auth::user();

        $workspaces = $user->workspaces;

        if (!$user->current_workspace_id) {
            $user->update(['current_workspace_id' => $workspaces->first()->id]);
        }

        return WorkspaceResource::collection($workspaces);
    }

    public function changeSelectedWorkspace(Request $request)
    {
        $request->validate(['workspace_id' => 'required|exists:workspaces,id']);
        $workspaceId = $request->get('workspace_id');

        $access = UserWorkingData::where('user_id',Auth::id())->where('workspace_id',$workspaceId)->exists();

        if (!$access) {
            return response()->json(['message' => 'Wrong workspace_id!'], 422);
        }

        Auth::user()->update(['current_workspace_id' => $workspaceId]);

        return response()->json([], 201);
    }

    public function getPrice(Request $request)
    {
        $request->validate(['employees' => ['integer', 'gt:0']]);

        $sum = $request->get('employees') * 200;

        return response()->json(['sum' => $sum]);
    }

    public function sendJoinRequest(Request $request)
    {
        CompanyRequest::create([
            'user_id' => $request->user_id,
            'company_id' => $request->company_id,
            'status' => CompanyRequest::IN_PROGRESS
        ]);
        return response('OK');
    }

    public function approveUserToWorkspace(Request $request)
    {

        $companyRequest = CompanyRequest::where('user_id', $request->user_id)
            ->where('company_id', $request->company_id)->first();

        if (!$companyRequest) {
            return response(['error' => 'Company Request not found'], 404);
        }

        $company = Company::find($request->company_id);

        if (!$company) {
            return response(['error' => 'Company not found'], 404);
        }

        DB::beginTransaction();

        try {
            $userWorkingData = UserWorkingData::create([
                'user_id' => $request->user_id,
                'company_id' => $request->company_id,
                'workspace_id' => $company->workspace_id
            ]);

            $userWorkingData->assignRole('user');

            $companyRequest->delete();

            DB::commit();

            return response(['success' => true, 'data' => $userWorkingData]);
        } catch (\Exception $e) {
            DB::rollback();

            return response(['error' => 'Failed to add user to the workspace: ' . $e->getMessage()], 500);
        }

        return response('OK');
    }

    public function unapproveUserToWorkspace(Request $request)
    {
        CompanyRequest::where('company_id', $request->company_id)->where('user_id', $request->user_id)->delete();
        return response('OK');
    }
}
