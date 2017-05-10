<?php

namespace Inayat\Http\Controllers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Inayat\Account;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function  index()
    {
        $user = User::all();
        $transactions = Account::where('status', '=', Account::STATUS_PENDING)->get();
        $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE);
        $credit = $credits->sum('amount');
        $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE);
        $debit = $debits->sum('amount');
        $totalTransactions = Account::all();

        return view('admin.index', compact('user', 'transactions', 'totalTransactions', 'credit', 'debit'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAccount()
    {
        return view('admin.create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function createAccount(Request $request)
    {
        $user = new User();

        if (User::where('phone', '=', $request->get('phone'))->exists()) {
            return Redirect::back()->with('warning', 'Member Already exists');
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
        $user->password = Hash::make('NewPassword01');
        $user->role = Role::MEMBER;
        $user->save();

        $kin = new Kin();
        $kin->name = $request->input('name');
        $kin->relationship = $request->input('relationship');
        $kin->kin_address = $request->input('kin-address');
        $kin->kin_phone = $request->input('kin-phone');
        $kin->user_id = $user->getAttribute('id');
        $kin->save();

        return redirect('/admin')->with('success', 'Member Account Successfully Created!');
    }

    /**
     * Get All Members
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMembers()
    {
        $members = User::all();

        return view('admin.members', compact('members'));
    }

    /**
     * Verify Credit Transaction
     * 
     * @param $id
     * @return array
     */
    public function verify($id)
    {
        $transaction = Account::findOrFail($id);
        if ($transaction) {
            $transaction->status = Account::STATUS_ACTIVE;
            $transaction->save();

            return ['status_code' => 200, 'message' => 'Course deleted successfully'];
        }

        return ['message' => 'The Operation Failed'];
    }

    /**
     * Decline Credit Transaction
     * 
     * @param $id
     * @return array
     */
    public function decline($id)
    {
        $transaction = Account::findOrFail($id);
        if ($transaction) {
            $transaction->status = Account::STATUS_DECLINED;
            $transaction->save();

            return ['status_code' => 200, 'message' => 'Course deleted successfully'];
        }

        return ['message' => 'The Operation Failed'];
    }

    /**
     * View Member's page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewMembers($id)
    {
        $user = User::where('registration', $id)->first();
        $transactions = Account::where('user_id', '=', $user->id)->get();

        return view('users.index', compact('user', 'transactions'));
    }
}
