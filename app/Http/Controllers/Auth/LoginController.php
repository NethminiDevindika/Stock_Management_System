<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function userLogin(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::guard('admin')
            ->attempt(['username' => $request->username, 'password' => $request->password],
                $request->remember)) {
            return redirect()->intended(route('cashier.index'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
