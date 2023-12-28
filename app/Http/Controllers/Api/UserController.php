<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class UserController extends Controller
{
    // forgot password reated api
    public function forgotPassword(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'email'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ), 422);
        }
        // Validation Section Ends

        $findedUser = User::where('email', $request->email)->first();

        if ($findedUser) {
            $otp = rand(pow(10, 6 - 1), pow(10, 6) - 1);

            $findedUser->otp = $otp;
            $findedUser->save();

            $to = $findedUser->email;
            $subject = 'Your otp for forgot password .';
            //Sending Email To User

            Mail::to($to)->send(new ForgotPasswordOtpMail($otp, $subject, $findedUser));

            return response()->json(['message' => 'You have to update your password. We have sent an otp to ' . $to . '. Please check your email to continue.', 'status' => 200], 200);
        } else {
            return response()->json(array('errors' => 'Email not found !', 'status' => 422), 422);
        }
    }

    public function forgotPasswordUpdate(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'email'     => 'required||exists:users,email',
            'otp'       => 'required',
            'password'  => 'required|confirmed'
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
                $user->password = Hash::make($request->password);
                $user->update();
                return response()->json(['message' => 'New password set successfully.',  'status' => 200], 200);
            } else {
                return response()->json(array('errors' => 'Invalid OTP !', 'status' => 422), 422);
            }
        } else {
            return response()->json(array('errors' => 'Invalid Email !', 'status' => 422), 422);
        }
    }

    // password reset related api
    public function resetPassword(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'old_password'  => 'required',
            'password'      => 'required|confirmed'
        ],);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ));
        }
        // Validation Section Ends

        $hashedPassword = auth()->user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                User::where('id', auth()->user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
                $user = User::find(auth()->user()->id, ['id', 'name', 'email', 'user_type', 'phone', 'status', 'avatar']);

                return response()->json(['user' => $user, 'message' => 'Password updated successfully .',  'status' => 200], 200);
            } else {
                return response()->json(array('errors' => 'New password can not be the old password !', 'status' => 422), 422);
            }
        } else {
            return response()->json(array('errors' => 'Old password does not matched !', 'status' => 422), 422);
        }
    }

    public function userInfo()
    {
        $user = User::find(auth()->user()->id, ['id', 'name', 'email', 'user_type', 'phone', 'status', 'avatar']);
        return response()->json(['user' => $user, 'message' => 'OK', 'status' => 200], 200);
    }

    public function profileUpdate(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'name'  => 'nullable|string',
            'phone' => 'nullable|string',
            'avatar' => 'nullable|mimes:jpg,jpeg,png',
        ],);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ));
        }
        // Validation Section Ends

        $user = User::find(auth()->user()->id);

        $user->name  = $request->name ?? $user->name;
        $user->phone = $request->phone ?? $user->phone;

        if ($request->hasFile('avatar')) {
            if ($user->avatar != null) {
                File::delete(public_path($user->avatar)); //Old image delete
            }
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/avatar/';
            $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->avatar =  $folder_path . $image_new_name;
        }
        $user->save();

        $user = User::find(auth()->user()->id, ['id', 'name', 'email', 'user_type', 'phone', 'status', 'avatar']);
        return response()->json(['user' => $user, 'message' => 'Profile Updated Successfully', 'status' => 200], 200);
    }

    public function parmanentlyDeleteAccount(Request $request)
    {
         // Validation Section Starts
         $validator = Validator::make($request->all(), [
            'password'  => 'required|string',
        ],[
            'password.required' => 'Password is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ));
        }
        // Validation Section Ends
        $user = User::find(auth()->user()->id, ['id', 'name','password', 'email', 'user_type', 'phone', 'status', 'avatar']);


        if(Hash::check($request->password, $user->password)){
            $user->makeHidden(['password']);
            if ($user->user_type == 'admin') {
                return response()->json(['message' => 'Admin should not delete his own account', 'status' => 403], 403);
            }else if ($user->user_type == 'client') {
                $user->load([
                    'customPackages' => function ($query) {
                        $query->each(function ($customPackage) {
                            $customPackage->packageGuides()->delete();
                            $customPackage->packageHotels()->delete();
                        });
                        $query->delete();
                    },                    
                    // 'serviceVouchers' => function ($query) {
                    //     $query->each(function ($customPackage) {
                    //         $customPackage->packageGuides()->delete();
                    //         $customPackage->packageHotels()->delete();
                    //     });
                    //     $query->delete();
                    // },
                ]);
            }
            $user->delete();
            return response()->json(['message' => 'Your account deleted successfully', 'status' => 200], 200);
        }else{
            return response()->json(['message' => 'Sorry password doesn\'t matched !', 'status' => 403], 403);
        }
    }
}
