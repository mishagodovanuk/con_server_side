<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\VerificationCodes;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    public function validateCode(Request $request)
    {
        $login = $request->get('login');
        $code = $request->get('code');

        $exists = VerificationCodes::where('login', $login)->where('code', $code)->first();

        if ($exists) {
            return response()->json([
                'message' => 'Successful validation.'
            ]);
        } else {
            return response()->json([
                'message' => 'Failed validation.'
            ], 422);
        }
    }
}
