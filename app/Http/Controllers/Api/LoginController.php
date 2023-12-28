<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validation Section Starts
        $validator = Validator::make($request->all(), [
            'email'     => 'required|exists:users,email',
            'password'  => 'required|min:6',
        ], [
            'email.exists' => 'Don\'t have any account with this email',
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                'errors' => $validator->getMessageBag()->toArray(),
                'status' => 422
            ), 422);
        }
        // Validation Section Ends

        // Attempt to log the user in
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(array('errors' => 'Credentials Doesn\'t Match !', 'status' => 422), 422);
        } else {
            if(auth()->user()->status == 0){
                auth()->user()->tokens->each(function ($token, $key) {
                    $token->delete();
                });        
                return response()->json(['message' => 'You are inactive for now, Please contact with admin to recative again !','status' => 403], 403);
                
            }else if(auth()->user()->user_type != 'client'){
                auth()->user()->tokens->each(function ($token, $key) {
                    $token->delete();
                });        
                return response()->json(['message' => 'Sorry ! This app is only for client.','status' => 403], 403);
            }else if(auth()->user()->otp_verified != true){
                auth()->user()->tokens->each(function ($token, $key) {
                    $token->delete();
                });        
                return response()->json(['message' => 'Please verify your otp .','status' => 403], 403);
            }else{
                $token = auth()->user()->createToken('API Token')->accessToken;
                $user = User::find(auth()->user()->id, ['id','name','email','user_type','phone','status', 'avatar']);

                return response()->json(['user' => $user, 'message' => 'Logged in successfully', 'token' => $token , 'status' => 200], 200);
            }
        }
    }

    public function logout(){
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged Out Successfully !', 'status' => 200], 200);
    }
}
