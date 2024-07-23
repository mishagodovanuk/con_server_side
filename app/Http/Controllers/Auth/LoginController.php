<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'login';
    }

    protected function credentials(Request $request)
    {
        $login = $request->get('login');
        $res = [
            'password' => $request->get('password')
        ];

        $validator = Validator::make(['email' => $login],[
            'email' => 'required|email'
        ]);

        if ($validator->passes()) {
            $res['email'] = $login;
        } else {
            $res['phone'] = $login;
        }

        return $res;
    }

    public function showLoginForm()
    {
        return view('auth.loginNew');
    }
}
