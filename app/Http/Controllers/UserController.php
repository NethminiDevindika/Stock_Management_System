<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function newUser()
    {
        return view('users.new_user');
    }
}
