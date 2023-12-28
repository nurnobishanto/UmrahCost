<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password'  => 'required',
            'password'      => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        if (Hash::check($request->old_password, auth()->user()->password)) {
            User::find(auth()->user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            Toastr::success('Password Changed Successfully', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } else {
            Toastr::error('Old Password Does Not Mathch', 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
        }
        return back();
    }

    public function edit()
    {
        $user = User::find(auth()->user()->id);

        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        $name = $request->name;

        $query = User::query()
                ->where('id', auth()->user()->id)
                ->update([
                    'name' => $name
                ]);

        if($query){
            Toastr::success('User Profile Updated Successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } else {
            Toastr::error('Whoops .Something went wrong!', 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }
        return back();
    }
}
