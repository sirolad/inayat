<?php

namespace Inayat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function editProfile()
    {
        return view('users.profile');
    }
}
