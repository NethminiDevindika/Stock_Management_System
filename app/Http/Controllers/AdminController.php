<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newUser()
    {
        return view('users.new_user');
    }

    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back();
    }

    public function users()
    {
        $users = User::withTrashed()
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('users.user_list', compact('users'));
    }

}
