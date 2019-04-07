<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/orders';

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
        return 't_number';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|integer',
            'password' => 'required|string',
        ], [
            'password.required' => 'Введіть пароль',
            $this->username().'.required' => 'Введіть табельний',
            $this->username().'.integer' => 'Табельний має бути числом',
        ]
        );
    }
}

