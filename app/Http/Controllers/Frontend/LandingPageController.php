<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomPackage;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {
        // dd('ok');
         Artisan::call('config:clear');
        if(auth()->user()){
            $packages = CustomPackage::where('client_id', auth()->user()->id)->with(['packageHotels','packageHotels.hotel','packageType','packageType.package'])
            ->orderBy('id', 'DESC')->get();
        }else{
            $packages = [];
        }
        return view('frontend.index', compact('packages'));
    }

    public function userRegister(Request $request){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'phone'     => 'required',
            'password'  => 'required',
        ]);

        try {

            $client  = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();
            
            if($client == null){
                $client      = new User();
                $client->user_type  = 'client';
            }
            
            $client->phone      = $request->phone;
            $client->email      = $request->email;
            $client->name       = $request->name;
            $client->password   = Hash::make($request->password);
            $client->save();
            
            if(auth()->attempt($request->only('email','password'))) {
                $otp = random_int(100000, 999999);
                $messsage = 'Your otp is '. $otp;
                $client->otp = $otp;
                $client->save();

                send_sms($request->phone,$messsage );
    
                return response()->json([
                    'status'=>200,
                    'message'=>'Please enter otp for varification.'
                ],200);             
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>'Credentials doesn\'t matched with our database .'
                ],500);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status'=>500,
                'message'=>'Whoops! Something went wrong. '.$exception->getMessage()
            ],500);
        }
    }

    public function userRegisterOtpForm(){

        return view('frontend.customPackage.userRegisterOtpForm');
    }

    public function userRegisterOtpVarify(Request $request){
        $request->validate([
            'otp' => 'required',
        ]);

        $user = User::find(auth()->user()->id);

        if ($user) {
            if ($user->otp == $request->otp) {       
                session()->forget('is_created_custom_package');
                         
                $customPackage = CustomPackage::where([['ip_address', $request->ip()],['is_verified_otp',0]])->update([
                    'client_id' => auth()->user()->id,
                    'is_verified_otp' => 1,
                ]);

                $user->otp_verified = true;
                $user->save();
                
                return response()->json([
                    'status'=>200,
                    'message'=>'Verified successfully'
                ],200);
            } else {
                return response()->json([
                    'status'=>500,
                    'message'=>'Otp Doesn\'t matched.'
                ],500);
            }
        } else {
            return response()->json([
                'status'=>500,
                'message'=>'Please Try Again !'
            ],500);
        }
    }
}
