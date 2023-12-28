<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Package List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  Package::all();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('currency_name', function ($data) {
                    return $data->currency?->name ?? '';
                })->addColumn('cost_of_visa', function ($data) {
                    return $data->cost_of_visa ?? '';
                })->addColumn('food_cost', function ($data) {   
                    return $data->food_cost ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.package.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.package.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Package Edit')){
                        $actionHtml .= ' <a href="' . route('admin.package.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Package Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.package.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }
                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','cost_of_visa','food_cost','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.package.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Package Create')){
            abort(403);
        }
        $currencies = Currency::where('status',1)->get();

        return view('admin.package.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Package Create')){
            abort(403);
        }
        $request->validate([
            'name'              => 'required|min:1|max:200',
            'cost_of_visa'      => 'required',
            'food_cost'         => 'required',
            'invoice_note'      => 'nullable',
            'currency'          => 'required|exists:currencies,id',
        ]);

        $package                    = new Package();
        $package->name              = $request->name;
        $package->cost_of_visa      = $request->cost_of_visa;
        $package->food_cost         = $request->food_cost;
        $package->invoice_note      = $request->invoice_note;
        $package->currency_id       = $request->currency;
        $package->status            = 1;

        try {
            $package->save();
            Toastr::success('Package added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Package View')){
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
        if(!check_permission('Package Edit')){
            abort(403);
        }
        $package    = Package::findOrFail($id);
        $currencies = Currency::where('status',1)->get();

        return view('admin.package.edit', compact('package','currencies'));
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
        if(!check_permission('Package Edit')){
            abort(403);
        }
        $package = Package::findOrFail($id);
        $request->validate([
            'name'              => 'required|min:3|max:100',
            'cost_of_visa'      => 'required',
            'food_cost'         => 'required',
            'invoice_note'      => 'nullable',
            'currency'          => 'required|exists:currencies,id',
        ]);

        $package->name = $request->name;
        $package->cost_of_visa      = $request->cost_of_visa;
        $package->food_cost         = $request->food_cost;
        $package->invoice_note      = $request->invoice_note;
        $package->currency_id       = $request->currency;
        $package->save();
        try {
            $package->save();
            Toastr::success('Package updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.package.index');
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
        if(!check_permission('Package Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $package = Package::findOrFail($id);
        try {

            $package->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Package deleted successfully !',
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
        if(!check_permission('Package Edit')){
            abort(403);
        }
        $request->validate([
            'id' => 'required|exists:packages,id',
        ]);
        $package = Package::find($request->input('id'));
        if ($package->status == 1) {
            $package->status = 0;
        } else {
            $package->status = 1;
        }
        try {
            $package->save();
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
