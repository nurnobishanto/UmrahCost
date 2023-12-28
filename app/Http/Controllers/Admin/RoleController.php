<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Role List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  Role::all();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('action', function ($data) {
                    $actionHtml = '<div class="edit-icons">
                                        <div class ="action-buttons">
                                    ';
                    if(check_permission('Role Permission Assign')){
                        $actionHtml .= ' <a href="' . route('admin.role.edit', $data->id) . '">
                                                <i class="far fa-edit bg-info"></i>
                                            </a>';
                    }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.role.index');
    }

    public function edit($role_id)
    {
        if(!check_permission('Role Permission Assign')){
            abort(403);
        }
        $role = Role::find($role_id);
        $permissionGroups = PermissionGroup::with('permissions')->get();

        return view('admin.role.edit', compact('role', 'permissionGroups'));
    }

    public function update(Request $request)
    {
        if(!check_permission('Role Permission Assign')){
            abort(403);
        }
        $request->validate([
            'role_id'       => 'required|exists:roles,id',
            'role_name'     => 'required|string|min:3|max:50|unique:roles,name,' . $request->input('role_id'),
            'permissions'   => 'required'
        ]);

        $role = Role::findOrFail($request->input('role_id'));

        try {

            RoleHasPermission::where('role_id', $request->role_id)->delete();

            foreach ($request->permissions as $key => $permission) {
                $roleHasPermission = new RoleHasPermission();
                $roleHasPermission->role_id = $role->id;
                $roleHasPermission->permission_id = $permission;
                $roleHasPermission->save();
            }

            Toastr::success('Successfully updated !', 'Success', ["positionClass" => "toast-top-right", "timeOut" => "2500"]);
        } catch (\Exception $exception) {
            Toastr::error('Whoops .Something went wrong!' . $exception->getMessage(), 'Error', ["positionClass" => "toast-top-center", "timeOut" => "2500"]);
        }
        return back();
    }
}
