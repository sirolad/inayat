<?php

namespace Inayat\Http\Controllers;

use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Inayat\Account;
use Inayat\Kin;
use Inayat\Role;
use Inayat\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
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
        $balance = $credit - $debit;
        $totalTransactions = Account::all();

        return view('admin.index', compact('user', 'transactions', 'totalTransactions', 'credit', 'debit',
            'balance'));
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
        $user->image = '';
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
        $members = User::paginate(15);

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
            $transaction->approver = Auth::user()->fullName();
            $transaction->save();

            return ['status_code' => 200, 'message' => 'Transaction Verified successfully'];
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
            $transaction->approver = Auth::user()->fullName();
            $transaction->save();

            return ['status_code' => 200, 'message' => 'Transaction Declined successfully'];
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
        if (isset($id)) {
            $user = User::where('registration', $id)->first();
            $transactions = Account::where('user_id', '=', $user->id)->get();
            $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE)->where('user_id', $user->id);
            $credit = $credits->sum('amount');
            $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE)->where('user_id', $user->id);
            $debit = $debits->sum('amount');
            $balance = $credit - $debit;

            return view('users.index', compact('user', 'transactions', 'balance'));
        }

        return abort(503);
    }

    /**
     * Get form to make transaction for members
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTransaction($id)
    {
        $user = User::findOrFail($id);

        return view('admin.payment', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeTransaction(Request $request,$id)
    {
        try {
            $pay = new Account();
            $pay->user_id = $id;
            $pay->amount = $request->input('amount');
            $pay->reference = $request->input('reference');
            $pay->transaction = $request->input('payment');
            $pay->status = Account::STATUS_ACTIVE;
            $pay->type = $request->input('type');
            $pay->save();

            return redirect('/admin/members')->with('success', 'Transaction Registered');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back()->with('danger', 'Transaction Failed');
        }
    }

    /**
     * Get all reports
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReports(Request $request)
    {
        if (!$request->query()) {
            $transactions = Account::all();
            $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE);
            $credit = $credits->sum('amount');
            $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE);
            $debit = $debits->sum('amount');
            $balance = $credit - $debit;

            return view('admin.reports', compact('transactions','credit', 'debit', 'balance'));
        }

        $query = $request->query();
        $transaction = $query['transaction'];
        //$type = $query['type'];
        $sort_type = [
            'credit' => 'credit',
            'debit' => 'debit',
            'savings' => 'savings',
            'education' => 'education',
            'loans' => 'loans',
            'ileya' => 'ileya',
            'admin_charges' => 'admin_charges',
            'special_savings' => 'special_savings',
            'commodity' => 'commodity',
            'shares' => 'shares',
            'ramadan' => 'ramadan'
        ];

        $transactions = Account::where('status', Account::STATUS_ACTIVE)->where('transaction', $sort_type[$transaction])->get();
        $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE)
            ->where('transaction', $sort_type[$transaction]);
        $credit = $credits->sum('amount');
        $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE)
            ->where('transaction', $sort_type[$transaction]);;
        $debit = $debits->sum('amount');
        $balance = $credit - $debit;

        return view('admin.reports', compact('transactions', 'credit', 'debit', 'balance'));
    }
}
