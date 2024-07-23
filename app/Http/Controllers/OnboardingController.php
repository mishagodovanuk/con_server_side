<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\LegalType;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserWorkingData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OnboardingController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $legalTypes = LegalType::all();
        return view('onboarding.create-company', compact('countries', 'legalTypes'));
    }

    public function addAdminToCompany(Request $request)
    {
        $user = User::find(Auth::id());

        $userWorkingData = UserWorkingData::create([
            'company_id' => $request->company_id,
            'user_id' => $user->id
        ]);

        $userWorkingData->assignRole('admin');

        Schedule::store($request->schedule, $userWorkingData->id);

        return response('OK');
    }

}
