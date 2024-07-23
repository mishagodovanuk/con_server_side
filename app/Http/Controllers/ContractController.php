<?php

namespace App\Http\Controllers;

use App\Enums\ContractStatus;
use App\Http\Requests\Contract\ContractCreateRequest;
use App\Http\Requests\Contract\ContractUpdateRequest;
use App\Http\Requests\Contract\DestroyContractRequest;
use App\Models\Company;
use App\Models\Contract;
use App\Models\ContractComment;
use App\Models\Regulation;
use App\Services\Contract\TableFacade;
use App\Traits\ContractDataTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    use ContractDataTrait;

    public function index()
    {
        $contracts = Contract::all();
        return view('contract.index', compact('contracts'));
    }

    public function create()
    {
        $companies = Company::filterByWorkspace()->select('companies.id')->addName()->get();
        $contractId = Contract::count() + 1;
        $regulations = Regulation::currentWorkspace()->where('parent_id', null)->where('draft', 0)->get();
        $typePallets = $this->typePallets;

        return view('contract.create', compact('companies', 'contractId', 'regulations', 'typePallets'));
    }

    public function show(Contract $contract)
    {
        $regulations = Regulation::currentWorkspace()->where('parent_id', null)->get();
        $typePallets = $this->typePallets;

        if ($contract->workspace_id === Auth::user()->current_workspace_id) {
            $side = 'вихідного';
        } else {
            $side = 'вхідного';
        }

        $sideName = $this->getSideName($contract);
        $roleName = $this->getRoleName($contract);
        $typeName = $this->getTypeName($contract);
        $userSide = $this->getSide($contract);

        $contract->load([
            'company' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'counterparty' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'comments.company' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'company_regulation.parent',
            'counterparty_regulation.parent'
        ]);

        if ($userSide) {
            $ownRegulation = $contract->company_regulation;
            $contractorRegulation = $contract->counterparty_regulation;
        } else {
            $ownRegulation = $contract->counterparty_regulation;
            $contractorRegulation = $contract->company_regulation;
        }

        if ($ownRegulation) {
            $ownRegulation['settings'] = $this->translitPaletName(json_decode($ownRegulation->settings, true));
        }
        if ($contractorRegulation) {
            $contractorRegulation['settings'] = $this->translitPaletName(json_decode($contractorRegulation->settings, true));
        }

        return view('contract.view', compact(
            'contract', 'side', 'sideName', 'roleName',
            'typeName', 'userSide', 'ownRegulation', 'contractorRegulation', 'regulations', 'typePallets'
        ));
    }

    public function store(ContractCreateRequest $request)
    {
        $contractData = $request->except(['_token', 'consideration_send', 'regulation_data', 'company_regulation_id']);
        $contractData['workspace_id'] = Auth::user()->current_workspace_id;

        $regulationId = $request->get('company_regulation_id');
        $regulationData = $request->get('regulation_data');

        if ($regulationId && is_array($regulationData)) {

            Regulation::where('id', $regulationId)->update($regulationData);
        } else if (!$regulationId && is_array($regulationData)) {

            $regulationData['workspace_id'] = Auth::user()->current_workspace_id;
            $regulation = Regulation::create($regulationData);
            $regulationId = $regulation->id;

            Regulation::fixTree();
        }
        $contractData['company_regulation_id'] = $regulationId;
        if ($request->get('consideration_send')) {

            $contractData['status'] = ContractStatus::PENDING_CONSOLIDATION;
        } else {

            $contractData['status'] = ContractStatus::CREATED;
        }
        $contractData['created_at'] = Carbon::now();

        $contract = Contract::create($contractData);

        return response()->json(['contract_id' => $contract->id]);
    }

    public function filter()
    {
        return TableFacade::getFilteredData();
    }

    public function createComment(Request $request)
    {
        $data = $request->except(['_token']);
        $comment = ContractComment::create($data);

        return response()->json(['comment_id' => $comment->id]);
    }

    public function changeStatus(Request $request)
    {
        $statusId = $request->get('status_id');
        $contractId = $request->get('contract_id');

        $newData = ['status' => $statusId];

        if ($statusId === ContractStatus::TERMINATED) {
            $newData['termination_reasons'] = $request->get('termination_reasons');
        }
        if ($statusId === ContractStatus::PENDING_SIGN) {
            if (!($counterpartyRegulationId = $request->get('counterparty_regulation_id'))) {
                return response()->json([
                    'message' => "Для підпису необхідно обрати регламент"
                ])->setStatusCode(422);
            }
            $newData['signed_at_counterparty'] = Carbon::now();
            $newData['counterparty_regulation_id'] = $counterpartyRegulationId;
        }
        if ($statusId === ContractStatus::PENDING_CONSOLIDATION) {
            $newData['signed_at_counterparty'] = null;
        }
        if ($statusId === ContractStatus::SIGNED_ALL) {
            $newData['signed_at'] = Carbon::now();
        }
        if (in_array($statusId, [ContractStatus::DECLINE, ContractStatus::DECLINE_CONTRACTOR])) {
            $newData['decline_reasons'] = $request->get('decline_reasons');
        }

        Contract::where('id', $contractId)->update($newData);

        return response('OK');
    }

    public function destroy(DestroyContractRequest $request, Contract $contract)
    {
        if ($contract->status !== ContractStatus::CREATED) {
            return response()->json([
                'message' => "Дозволено видалення контрактів лише з статусом Створено"
            ])->setStatusCode(422);
        }
        $contract->delete();

        return response()->json('Successful destroy');
    }

    public function edit(Contract $contract)
    {
        $companies = Company::filterByWorkspace()->select('companies.id')->addName()->get();
        $regulations = Regulation::currentWorkspace()->where('parent_id', null)->where('draft', 0)->get();
        $typePallets = $this->typePallets;

        $contract->load([
            'company' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'counterparty' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'comments.company' => function ($q) {
                $q->select('companies.id')->addName();
            },
            'company_regulation.parent',
            'counterparty_regulation.parent'
        ]);

        return view('contract.edit', compact('companies', 'regulations', 'typePallets', 'contract'));
    }

    public function update(ContractUpdateRequest $request, Contract $contract)
    {
        if ($contract->status !== ContractStatus::CREATED) {
            return response()->json([
                'message' => "Дозволено видалення контрактів лише з статусом Створено"
            ])->setStatusCode(422);
        }

        $contractData = $request->except(['_token', 'consideration_send', 'regulation_data', 'company_regulation_id']);

        $regulationId = $request->get('company_regulation_id');
        $regulationData = $request->get('regulation_data');

        if ($regulationId && is_array($regulationData)) {

            Regulation::where('id', $regulationId)->update($regulationData);
        } else if (!$regulationId && is_array($regulationData)) {

            $regulationData['workspace_id'] = Auth::user()->current_workspace_id;
            $regulation = Regulation::create($regulationData);
            $regulationId = $regulation->id;

            Regulation::fixTree();
        }

        if ($request->get('consideration_send')) {

            $contractData['status'] = ContractStatus::PENDING_CONSOLIDATION;
        } else {

            $contractData['status'] = ContractStatus::CREATED;
        }
        $contractData['created_at'] = Carbon::now();

        $contractData['company_regulation_id'] = $regulationId;

        $contract->fill($contractData);
        $contract->save();

        return response()->json(['contract_id' => $contract->id]);
    }

}
