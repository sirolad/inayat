<?php

namespace Inayat\Http\Controllers;

use Inayat\Account;
use Inayat\Kin;
use Inayat\User;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $userId = Auth::user()->getAuthIdentifier();
        $transactions = Account::where('user_id', '=', $userId)->get();
        $credits = Account::where('type', 'credit')->where('status', Account::STATUS_ACTIVE)->where('user_id', $userId);
        $credit = $credits->sum('amount');
        $debits = Account::where('type', 'debit')->where('status', Account::STATUS_ACTIVE)->where('user_id', $userId);
        $debit = $debits->sum('amount');
        $balance = $credit - $debit;

        return view('users.index', compact('user', 'transactions', 'balance'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewProfile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfile(Request $request)
    {
        $currentUser = User::where('phone', '=', Auth::user()->phone);
        $user = User::find(Auth::user()->getAuthIdentifier());

        if (($currentUser)->exists()) {
            $user->surname = $request->input('surname');
            $user->firstName = $request->input('first-name');
            $user->middleName = $request->input('middle-name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->permanentAddress = $request->input('permanentAddress');
            $user->occupation = $request->input('occupation');
            $user->save();

            return redirect('/edit-profile')->with('success', 'Profile Updated Successfully');
        }

        return redirect('/edit-profile')->with('danger', 'There was an Error. Update failed.');
    }

    /**
     * Change Password Function
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->getAuthIdentifier());
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;

        if (Hash::check($oldPassword, $user->password)) {
            if ($newPassword === $confirmPassword) {
                $user->password = bcrypt($confirmPassword);
                $user->save();

                return redirect('/edit-profile')->with('success', 'Password Updated Successfully');
            }

            return redirect('/edit-profile')->with('danger', 'Check the New Password Again');
        }

        return redirect('/edit-profile')->with('danger', 'Your Old Password is wrong!');
    }

    /**
     * Upload Image
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImage(Request $request)
    {
        $img = $request->file('avatar');

        if (isset($img)) {
            Cloudder::upload($img);
            $imgurl = Cloudder::getResult()['url'];

            User::find(Auth::user()->id)->updateAvatar($imgurl);

            return redirect('/edit-profile')->with('success', 'Avatar updated successfully');
        }

        return back()->with('danger', 'You need to select a file!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateKin(Request $request)
    {
        $nextKin = Kin::where('user_id', Auth::user()->getAuthIdentifier())->first();

        $nextKin->name = $request->input('name');
        $nextKin->relationship = $request->input('relationship');
        $nextKin->kin_phone = $request->input('kin-phone');
        $nextKin->kin_address = $request->input('kin-address');
        $nextKin->save();

        return redirect('/edit-profile')->with('success', 'Next of Kin Info Updated Successfully');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTransaction()
    {
        return view('users.payment');
    }

    /**
     * Make Transaction
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeTransaction(Request $request)
    {
        try {
            $pay = new Account();
            $pay->user_id = Auth::user()->getAuthIdentifier();
            $pay->amount = $request->input('amount');
            $pay->reference = $request->input('reference');
            $pay->transaction = $request->input('payment');
            $pay->status = Account::STATUS_PENDING;
            $pay->type = Account::TYPE_CREDIT;
            $pay->save();

            return redirect('/transaction')->with('success', 'Transaction Registered');
        } catch (\Exception $e) {
            Bugsnag::notifyException($e);
            return redirect('/transaction')->with('danger', 'Transaction Failed');
        }
    }
}
