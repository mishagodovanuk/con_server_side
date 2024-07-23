<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\API\ApiPasswordRequest;
use App\Http\Requests\User\API\ApiPinRequest;
use App\Http\Requests\User\PrivateDataRequest;
use App\Http\Requests\User\WorkingDataRequest;
use App\Http\Requests\Warehouse\MainDataRequest;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

class ValidatorController extends Controller
{
    public function validatePrivateData(PrivateDataRequest $request)
    {
        return response('OK');
    }

    public function validateWorkingData(WorkingDataRequest $request)
    {
        return response('OK');
    }

    public function validateUserInWorkspace(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            return (bool)$user->workingData;
        }

        return false;
    }

    public function validatePasswordData(ApiPasswordRequest $request)
    {
        return response('OK');
    }

    public function validatePinData(ApiPinRequest $request)
    {
        return response('OK');
    }

    public function validateWarehouseData(MainDataRequest $data)
    {
        return response('OK');
    }
}
