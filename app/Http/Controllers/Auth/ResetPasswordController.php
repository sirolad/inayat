<?php

namespace Inayat\Http\Controllers\Auth;

use Inayat\User;
use Illuminate\Http\Request;
use Inayat\Mail\ResetPasswords;
use Unicodeveloper\Jusibe\Jusibe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Inayat\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Reset Password
     * @param  Request $request
     * @return   Redirect
     */
    public function reset(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric'
        ]);

        $phone = $request->input('phone');
        $user = User::where('phone', '=', $phone);
        DB::transaction(function () use($user, $phone) {
            if ($user->exists()) {
                $password = str_random(8);
                $user = $user->first();
                $user->password = Hash::make($password);
                $user->save();
                $message = "Dear $user->firstName, Your password reset was successful. 
                Password: $password";
                Mail::to($user->email)->cc('surajudeen.akande@andela.com')->send(new ResetPasswords($user, $password));
                $this->sendSMS($phone, $message);
                return redirect('/forgot-password')->with('success', 'Kindly Check Your Mail');
            }
        });


        return redirect('/')->with('danger', 'User does not exist!');
    }

    public function sendSMS($phone, $message)
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
}
