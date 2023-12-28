<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;


class CRMController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('CRM List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  User::where('user_type','crm')->get();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('email', function ($data) {
                    return $data->email ?? '';
                })->addColumn('phone', function ($data) {
                    return $data?->phone ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.crm.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.crm.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
                    }
                    $statusHtml .=  '<div class="toggle-switch">
                                        <span class="on"><i class="fas fa-check"></i></span>
                                        <span class="off"><i class="fas fa-times"></i></span>
                                    </div>';
                    $statusHtml .= '</label>';
                    return $statusHtml;
                })->addColumn('action', function ($data) {
                    $actionHtml = '<div class="edit-icons">
                                        <div class ="action-buttons">
                                    ';
                        if(check_permission('CRM Edit')){
                            $actionHtml .= ' <a href="' . route('admin.crm.edit', $data->id) . '">
                                                <i class="far fa-edit bg-info"></i>
                                            </a>';
                        }
                        if(check_permission('CRM Delete')){
                            $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.crm.destroy', $data->id) . '">
                                                <i class="fa fa-trash bg-lightdanger"></i>
                                            </a>';
                        }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','email' ,'phone','status','action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.crm.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('CRM Create')){
            abort(403);
        }
        return view('admin.crm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('CRM Create')){
            abort(403);
        }
        $request->validate([
            'name' => 'required|min:1|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'avatar'=> 'nullable|mimes:jpg,jpeg,png',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->user_type = 'crm';
        $user->password = Hash::make($request->password);

        $messsage = 'Your Email is '.$request->email.' and Your password is '. $request->password;
        send_sms($request->phone,$messsage );

        if ($request->hasFile('avatar')) {
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/avatar/';
            $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->avatar =  $folder_path . $image_new_name;
        }
        $user->status = 1;

        try {
            $user->save();
            Toastr::success('CRM added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!check_permission('CRM View')){
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!check_permission('CRM Edit')){
            abort(403);
        }
        $user = User::findOrFail($id);

        return view('admin.crm.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!check_permission('CRM Edit')){
            abort(403);
        }
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'phone' => 'required',
            'avatar'=> 'nullable|mimes:jpg,jpeg,png',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar != null){
                File::delete(public_path($user->avatar)); //Old image delete
            }
            $image             = $request->file('avatar');
            $folder_path       = 'uploads/images/avatar/';
            $image_new_name    = Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
            //resize and save to server
            Image::make($image->getRealPath())->save($folder_path . $image_new_name);
            $user->avatar =  $folder_path . $image_new_name;
        }
        try {
            $user->save();
            Toastr::success('CRM updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.crm.index');
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center","timeOut" => "2500"]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!check_permission('CRM Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $user = User::findOrFail($id);
        try {

            $user->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'User deleted successfully !',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    // this method used for update user status active or inactive
    public function statusChange(Request $request)
    {
        if(!check_permission('CRM Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);
        $user = User::find($request->input('id'));
        if ($user->status == 1) {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        try {
            $user->save();
            return response()->json([
                'type' => 'success',
                'message' => 'Status changed successfully.',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .Something went wrong!' . $exception->getMessage(),
            ]);
        }
    }
}
