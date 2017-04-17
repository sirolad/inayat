<?php

namespace Inayat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('users.index', compact('user'));
    }

    public function editProfile()
    {
        return view('users.profile');
    }
}
