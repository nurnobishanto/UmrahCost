<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use Yajra\DataTables\Facades\DataTables;
use Brian2694\Toastr\Facades\Toastr;


class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        if(!check_permission('Currency List')){
            abort(403);
        }
        if ($request->ajax()) {
            $data =  Currency::all();

            return datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name ?? '';
                })->addColumn('sign', function ($data) {
                    return $data->sign ?? '';
                })->addColumn('value', function ($data) {   
                    return $data->value ?? '';
                })->addColumn('status', function ($data) {
                    $statusHtml = ' <label class="toggle">';
                    if ($data->status == 0) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.currency.status.change') . '\')" class="toggle-checkbox" type="checkbox" >';
                    } elseif ($data->status == 1) {
                        $statusHtml .= '<input onclick="change_status(\'' . $data->id . '\',\'' . $data->status . '\',\'' . route('admin.currency.status.change') . '\')" class="toggle-checkbox" type="checkbox" checked >';
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
                    if(check_permission('Currency Edit')){
                        $actionHtml .= ' <a href="' . route('admin.currency.edit', $data->id) . '">
                                            <i class="far fa-edit bg-info"></i>
                                        </a>';
                    }
                    if(check_permission('Currency Delete')){
                        $actionHtml .= ' <a href="#" id="helper_delete'.$data->id.'"  onclick="delete_function('.$data->id.')" value="' . route('admin.currency.destroy', $data->id) . '">
                                            <i class="fa fa-trash bg-lightdanger"></i>
                                        </a>';
                    }

                    $actionHtml .= '</div>
                                    </div> ';
                    return $actionHtml;
                })
                ->rawColumns(['name','sign','value','status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.currency.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_permission('Currency Create')){
            abort(403);
        }
        return view('admin.currency.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_permission('Currency Create')){
            abort(403);
        }
        $request->validate([
            'name'      => 'required|min:1|max:200',
            'sign'      => 'required',
            'value'     => 'required',
        ]);

        $currency            = new Currency();
        $currency->name      = $request->name;
        $currency->sign      = $request->sign;
        $currency->value     = $request->value;
        $currency->status    = 1;

        try {
            $currency->save();
            Toastr::success('Currency added successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
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
        if(!check_permission('Currency View')){
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
        if(!check_permission('Currency Edit')){
            abort(403);
        }
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit', compact('currency'));
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
        if(!check_permission('Currency Edit')){
            abort(403);
        }
        $currency = Currency::findOrFail($id);
        $request->validate([
            'name'      => 'required|min:1|max:200',
            'sign'      => 'required',
            'value'     => 'required',
        ]);

        $currency->name      = $request->name;
        $currency->sign      = $request->sign;
        $currency->value     = $request->value;
        try {
            $currency->save();
            Toastr::success('Currency updated successfully !', 'Success', ["positionClass" => "toast-top-right","timeOut" => "2500"]);
            return redirect()->route('admin.currency.index');
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
        if(!check_permission('Currency Delete')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $currency = Currency::findOrFail($id);
        try {

            $currency->delete();
            return response()->json([
                'type' => 'success',
                'message' => 'Currency deleted successfully !',
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
        if(!check_permission('Currency Edit')){
            return response()->json([
                'type' => 'error',
                'message' => 'Whoops .You don\'t have this permission !',
            ]);
        }
        $request->validate([
            'id' => 'required|exists:currencies,id',
        ]);
        $currency = Currency::find($request->input('id'));
        if ($currency->status == 1) {
            $currency->status = 0;
        } else {
            $currency->status = 1;
        }
        
        try {
            $currency->save();
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
