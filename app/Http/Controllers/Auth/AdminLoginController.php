<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')
            ->attempt(['username' => $request->username, 'password' => $request->password],
                $request->remember)) {
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
