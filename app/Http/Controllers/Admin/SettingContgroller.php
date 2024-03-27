<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class SettingContgroller extends Controller
{
    public function information(){
        if(!check_permission('Application Information Update')){
            abort(403);
        }
        return view('admin.setting.information');
    }

    public function informationUpdate(Request $request){
        if(!check_permission('Application Information Update')){
            abort(403);
        }
        $request->validate([
            'company_name'          => 'required',
            'phone'                 => 'required',
            'email'                 => 'required',
            'address'               => 'required',
            'logo'                  => 'nullable|mimes:png,jpg,jpeg',
        ]);

        try {
            update_static_option('company_name', $request->company_name);
            update_static_option('phone', $request->phone);
            update_static_option('email', $request->email);
            update_static_option('address', $request->address);

            if ($request->hasFile('logo')) {
                if (get_static_option('logo') != null){
                    File::delete(public_path(get_static_option('logo'))); //Old image delete
                }
                $image             = $request->file('logo');
                $folder_path       = 'uploads/images/slider/';
                $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
                //resize and save to server
                Image::make($image->getRealPath())->save($folder_path . $image_new_name);
                update_static_option('logo', $folder_path . $image_new_name);
            }

            Toastr::success('Information updated successfully !', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
        }

        return back();
    }

    public function sms(){
        if(!check_permission('SMS Setting')){
            abort(403);
        }
        return view('admin.setting.sms');
    }

    public function smsUpdate(Request $request){
        if(!check_permission('SMS Setting')){
            abort(403);
        }
        $request->validate([
            'bulksmsbd_sender_id'          => 'required',
            'bulksmsbd_api'                 => 'required',
        ]);

        try {
            update_static_option('bulksmsbd_sender_id', $request->bulksmsbd_sender_id);
            update_static_option('bulksmsbd_api', $request->bulksmsbd_api);


            Toastr::success('SMS updated successfully !', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
        }

        return back();
    }
}
