<?php

namespace Inayat\Http\Controllers;

use Excel;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Inayat\Account;
use Inayat\Kin;
use Inayat\Role;
use Inayat\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inayat\Mail\RegistrationActive;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\JusibePack\Facades\Jusibe;

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
    public function index()
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
        $this->validate($request, [
            'registration' => 'required|unique:users|string',
            'surname' => 'required|string',
            'first-name' => 'required|string',
            'middle-name' => 'required|string',
            'phone' => 'required|unique:users|digits:11',
            'email' => 'required|unique:users|string',
            'sex'  => 'required|string',
            'dob' => 'required|date',
            'maritalStatus' => 'required|string',
            'address' => 'required|string',
            'permanentAddress' => 'required|string',
            'occupation' => 'required|string',
            'role' => 'required|integer',
            'name' => 'required|string',
            'relationship' => 'required|string',
            'kin-address' => 'required|string',
            'kin-phone' => 'required|digits:11'
        ]);

        $user = new User();

        if (User::where('phone', '=', $request->get('phone'))->exists()) {
            return Redirect::back()->with('warning', 'Member Already exists');
        }

        $password = str_random(8);
        $email = $request->input('email');

        $user->registration = $request->input('registration');
        $user->surname = $request->input('surname');
        $user->firstName = $request->input('first-name');
        $user->middleName = $request->input('middle-name');
        $user->phone = $request->input('phone');
        $user->email = $email;
        $user->sex = $request->input('sex');
        $user->dob = $request->input('dob');
        $user->maritalStatus = $request->input('maritalStatus');
        $user->address = $request->input('address');
        $user->permanentAddress = $request->input('permanentAddress');
        $user->occupation = $request->input('occupation');
        $user->status = User::ACTIVE;
        $user->password = Hash::make($password);
        $user->role = $request->input('role');
        $user->save();

        $kin = new Kin();
        $kin->name = $request->input('name');
        $kin->relationship = $request->input('relationship');
        $kin->kin_address = $request->input('kin-address');
        $kin->kin_phone = $request->input('kin-phone');
        $kin->user_id = $user->getAttribute('id');
        $kin->save();

        Mail::to($email)->cc('surajudeen.akande@andela.com')->send(new RegistrationActive($user, $password));
        $message = "Dear $user->firstName, Your account has been registered on Al-inayat. 
        Password: $password";
        $this->sendMessage($user->phone, $message);

        return redirect('/admin')->with('success', 'Member Account Successfully Created!');
    }

    public function sendMessage($phone, $message)
    {
        $payload = [
            'to' => $phone,
            'from' => 'Al-Inayat',
            'message' => $message
        ];

        try {
            Jusibe::sendSMS($payload)->getResponse();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
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
            $transactions = Account::where('user_id', $user->id)->get();
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
        $this->validate($request, [
            'amount' => 'required|integer',
            'reference' => 'required|string',
            'payment' => 'required|string',
            'type' => 'required|string',
        ]);

        try {
            $pay = new Account();
            $pay->user_id = $id;
            $pay->amount = $request->input('amount');
            $pay->reference = $request->input('reference');
            $pay->transaction = $request->input('payment');
            $pay->status = Account::STATUS_ACTIVE;
            $pay->type = $request->input('type');
            $pay->approver = Auth::user()->fullName();
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
        $query = $request->query();

        if (isset($query['transaction'])) {
            $transaction = $query['transaction'];
        }

        if (!$request->query() || $transaction == 'all') {
            return $this->getAllReports();
        }

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

        $type = ucfirst($sort_type[$transaction]);
        $transactions = Account::where('status', Account::STATUS_ACTIVE)
        ->where('transaction', $sort_type[$transaction])
        ->paginate(15);
        $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE)
            ->where('transaction', $sort_type[$transaction]);
        $credit = $credits->sum('amount');
        $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE)
            ->where('transaction', $sort_type[$transaction]);;
        $debit = $debits->sum('amount');
        $balance = $credit - $debit;

        return view('admin.reports', compact('transactions', 'credit', 'debit', 'balance', 'type'));
    }

    /**
     * Get All Reports
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllReports()
    {
            $transactions = Account::paginate(15);
            $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE);
            $credit = $credits->sum('amount');
            $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE);
            $debit = $debits->sum('amount');
            $balance = $credit - $debit;
            $type = 'All';

            return view('admin.reports', compact('transactions','credit', 'debit', 'balance', 'type'));
    }

    /**
     * Get CSV report of members
     *
     * @return Redirect
     */
    public function csvMembers()
    {
        $users = User::select('id', 'registration', 'surname', 'firstName', 'middleName',
            'phone', 'email', 'sex', 'dob', 'maritalStatus', 'address', 'occupation')->get();
        Excel::create('members', function($excel) use($users) {
            $excel->sheet('Sheet 1', function($sheet) use($users) {
                $sheet->fromArray($users);
            });
        })->export('xls');

        return Redirect::back();
    }

    /**
     * Get CSV report of transactions
     *
     * @return Redirect
     */
    public function csvTransactions()
    {
        // if (!$query || $query['transaction'] == 'all') {
            $transactions = Account::all();
        // } else {
            // $transactions = Account::where('transaction', $type);
        // }

        Excel::create('transactions', function($excel) use($transactions) {
            $excel->sheet('Sheet 1', function($sheet) use($transactions) {
                $sheet->fromArray($transactions);
            });
        })->export('xls');

        return Redirect::back();
    }

    /**
     * [deleteMember description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function deleteMember(Request $request,$id)
    {
        $member = User::where('registration', $id);
        if ($member) {
            $member->delete();

            return redirect('/admin/members')->with('success', 'Member Deleted successfully');
        }

        Redirect::back()->with('error', 'Opeartion Not Successful.');
    }

    /**
     * [deleteTransaction description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function deleteTransaction(Request $request,$id)
    {
        $transaction = Account::findOrFail($id);
        if ($transaction) {
            $transaction->delete();

            return redirect('/admin/all-reports')->with('success', 'Transaction Deleted successfully');
        }

        Redirect::back()->with('error', 'Opeartion Not Successful.');
    }

    /**
     * [editMember description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editMember($id)
    {
        $member = User::where('registration', $id)->first();

        return view('admin.profile', compact('member'));
    }

    /**
     * [updateMember description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function updateMember(Request $request, $id)
    {
        try{
            $member = User::find($id);
            $member->surname = $request->input('surname');
            $member->firstName = $request->input('first-name');
            $member->middleName = $request->input('middle-name');
            $member->phone = $request->input('phone');
            $member->email = $request->input('email');
            $member->address = $request->input('address');
            $member->maritalStatus = $request->input('maritalStatus');
            $member->permanentAddress = $request->input('permanentAddress');
            $member->occupation = $request->input('occupation');
            $member->save();

            return Redirect::back()->with('success', 'Profile Updated Successfully');
        } catch(Exception $e) {
            return Redirect::back()->with('danger', 'Operation Not Successful!');
        }
    }

    /**
     * [editTransaction description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function editTransaction($id)
    {
        $transaction = Account::where('id', $id)->first();

        return view('admin.edit', compact('transaction'));
    }

    /**
     * [updateTransaction description]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function updateTransaction(Request $request, $id)
    {
        try {
            $transaction = Account::where('id', $id)->first();
            $transaction->user_id = $transaction->user_id;
            $transaction->amount = $request->input('amount');
            $transaction->reference = $request->input('reference');
            $transaction->transaction = $request->input('transaction');
            $transaction->status = Account::STATUS_ACTIVE;
            $transaction->type = $request->input('type');
            $transaction->approver = Auth::user()->fullName();
            $transaction->save();

            return Redirect::back()->with('success', 'Transaction Registered');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return back()->with('danger', 'Operation Failed');
        }
    }
}
