<?php

namespace Inayat\Http\Controllers;

use Inayat\Kin;
use Inayat\Role;
use Inayat\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function  index()
    {
        $user = User::all();
        return view('admin.index', compact('user'));
    }

    public function showAccount()
    {
        return view('admin.create');
    }

    public function createAccount(Request $request)
    {
        $user = new User();

        if (User::where('phone', '=', $request->get('phone'))->exists()) {
            return Redirect::back()-with('warning', 'Member Already exists');
        }

        $user->registration = $request->input('registration');
        $user->surname = $request->input('surname');
        $user->firstName = $request->input('first-name');
        $user->middleName = $request->input('middle-name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->sex = $request->input('sex');
        $user->dob = $request->input('dob');
        $user->maritalStatus = $request->input('maritalStatus');
        $user->address = $request->input('address');
        $user->permanentAddress = $request->input('permanentAddress');
        $user->occupation = $request->input('occupation');
        $user->status = User::ACTIVE;
        $user->image = 'avatar.jpg';
        $user->password = Hash::make('NewPasswordO1');
        $user->role = Role::MEMBER;
        $user->save();

        $kin = new Kin();
        $kin->name = $request->input('name');
        $kin->relationship = $request->input('relationship');
        $kin->kin_address = $request->input('kin-address');
        $kin->kin_phone = $request->input('kin-phone');
        $kin->memberId = $request->input('registration');
        $kin->save();

        return redirect('admin.index')-with('info', 'Member Account Successfully Created!');
    }
}
