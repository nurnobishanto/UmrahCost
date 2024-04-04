<?php

namespace App\Http\Controllers;

use App\Mail\SentCredentialAfterCreateUserMail;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_view(){
        return view('auth.login');
    }
    public function register_view(){
        return view('auth.register');
    }
    public function register_verify(){
        $data = array();
        $registrationData = Session::get('registration_data');
        $data['phone'] = number_validation($registrationData['phone']);
        return view('auth.otp',$data);
    }
    public function resend_otp(){

        $registrationData = Session::get('registration_data');
        $otp = new OTP();
        $otp->generateOrUpdateOTP(number_validation($registrationData['phone']));
        toastr()->success('OTP Sent to '.number_validation($registrationData['phone']));
        return redirect(route('web.register_verify'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'phone' => 'required|string|unique:users|regex:/^\d{10,13}$/',
            'password' => 'required|string|min:6|confirmed',
        ]);
        Session::forget('registration_data');
        Session::put('registration_data',$request->all());
        $registrationData = Session::get('registration_data');
        $otp = new OTP();
        $otp->generateOrUpdateOTP(number_validation($registrationData['phone']));

        toastr()->success('OTP Sent to '.number_validation($registrationData['phone']));
        return redirect(route('web.register_verify'));
    }
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        // Determine if the user is logging in with email or phone
        $field = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt to authenticate the user
        if (Auth::attempt([$field => $request->email_or_phone, 'password' => $request->password])) {
            return redirect(route('frontend.index'));
        } else {
            // Authentication failed
            return back()->withInput()->withErrors(['email_or_phone' => 'Invalid credentials']);
        }
    }
    public function verifyOtp(Request $request)
    {
        // Validate OTP sent by the user
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);
        $registrationData = Session::get('registration_data');
        $otp = new OTP();
        $status = $otp->checkOTP(number_validation($registrationData['phone']), $request->otp);

        if ($status){
            $user                   = new User();
            $user->name             = $registrationData['first_name'].' '.$registrationData['last_name'];
            $user->email            = $registrationData['email'];
            $user->phone            = $registrationData['phone'];
            $user->number_of_person =  1;
            $user->user_type        = 'client';
            $user->password         = Hash::make($registrationData['password']);
            $user->status           = 1;
            $user->otp_verified   = 1;
            $user->save();
            Auth::attempt(['email' => $registrationData['email'], 'password' => $registrationData['password']]);
            OTP::where('phone', number_validation($registrationData['phone']))
                ->where('code', $request->otp)
                ->where('type', 'register')
                ->delete();
            $url = env('APP_URL');
            $subject = 'Your Credentials of Zamzam Travels';

            Mail::to($user?->email)->send(new SentCredentialAfterCreateUserMail($url, $subject, $user, $registrationData['password']));
            $msgBody = 'জমজম ট্রাভেলস এ আপনার অ্যাকাউন্ট তৈরি করা হয়েছে।';
            bulksmsbd_sms_send($user->phone,$msgBody);
            Session::forget('registration_data');
            return redirect(route('frontend.index'));
        }else{
            toastr()->error("Invalid OTP");
        }
        return redirect(route('web.register_verify'));

    }
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();
        // Optionally, clear the user's session and cookies
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('frontend.index'));

    }
    public function resetPasswordView(){
        return view('auth.forgot-password');
    }
    public function resetPassword(Request $request){
        $request->validate([
            'email_or_phone' => 'required',
        ]);
        $field = filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = User::where($field,$request->email_or_phone)->first();
        if ($user){
            Session::forget('forget_key');
            Session::forget('forget_value');
            Session::put('forget_key',$field);
            Session::put('forget_value',$request->email_or_phone);

            $otp = new OTP();
            $otp->generateOrUpdateOTP(number_validation($user->phone),'forget');
            toastr()->success('OTP Has been sent successfully');
            return redirect(route('web.passwordChange'));
        }else{
            toastr()->error('User not Fund!');
            return redirect()->back();
        }

    }
    public function passwordChange(){
        $data = array();
        $data['key'] = Session::get('forget_key');
        $data['value'] = Session::get('forget_value');
        return view('auth.change_password',$data);
    }
    public function verify_otp_change_pass(Request $request){
        $request->validate([
            'otp' => 'required|numeric|digits:6',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $key = Session::get('forget_key');
        $value = Session::get('forget_value');
        $user = User::where($key,$value)->first();
        if ($user){
            $otp = new OTP();
            $status = $otp->checkOTP(number_validation($user->phone), $request->otp,'forget');
            if ($status){
                $user->password = Hash::make($request->password);
                $user->update();


                Auth::attempt(['email' =>$user->phone, 'password' => $request->password]);
                OTP::where('phone', number_validation($user->phone))
                    ->where('code', $request->otp)
                    ->where('type', 'forget')
                    ->delete();
                $url = env('APP_URL');
                $subject = 'Your Credentials Hass Been Updated';

                Mail::to($user?->email)->send(new SentCredentialAfterCreateUserMail($url, $subject, $user, $request->password));
                $msgBody = 'জমজম ট্রাভেলস এ আপনার পাসওয়ার্ড পরিবর্তন করা হয়েছে।';
                bulksmsbd_sms_send($user->phone,$msgBody);
                Session::forget('forget_key');
                Session::forget('forget_value');
                toastr()->success('Password Changed Successfully');
                return redirect(route('frontend.index'));
            }else{
                toastr()->error('Invalid OTP');
                return redirect()->back();
            }
        }else{
            toastr()->error('Something Went Wrong');
            return redirect()->back();
        }

    }
}
