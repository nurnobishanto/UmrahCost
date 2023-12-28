<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegsiterController extends Controller
{
    public function register(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'phone'         => 'required|unique:users,phone',
            'email'         => 'required|unique:users,email',
            'password'      => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ), 422);
        }
        // Validation Section Ends

        DB::beginTransaction();
        try {

            $user           = new User();
            $user->name     = $request->name;
            $user->phone    = $request->phone;
            $user->email    = $request->email;
            $user->user_type = 'client';
            $user->password = Hash::make($request->password);

            $otp = random_int(100000, 999999);
            $messsage = 'Your otp is '. $otp;
            $user->otp = $otp;
            $user->save();

            send_sms($request->phone,$messsage);

            DB::commit();

            return response()->json(['message' => 'Registered successfully ! Please verify otp on your phone.',  'status' => 200], 200);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(array('errors' => 'Whoops ! Something went wrong.Please try again.' . $exception->getMessage(), 'status' => 422), 422);
        }
    }

    public function otpVerify(Request $request){
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'email'     => 'required||exists:users,email',
            'otp'       => 'required',
        ],);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ), 422);
        }
        // Validation Section Ends

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->otp == $request->otp) {
                $user->otp_verified = true;
                $user->update();
                return response()->json(['message' => 'Otp Verified Successfully .',  'status' => 200], 200);
            } else {
                return response()->json(array('errors' => 'Invalid OTP !', 'status' => 422), 422);
            }
        } else {
            return response()->json(array('errors' => 'Invalid Email !', 'status' => 422), 422);
        }
    }
}
