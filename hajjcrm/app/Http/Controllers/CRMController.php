<?php

namespace App\Http\Controllers;

use App\Models\CRM;
use Illuminate\Http\Request;

class CRMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crms=CRM::orderBy('id', 'desc')->get();
        return view('crm.index', compact( 'crms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> 'required'
        ]);

        $crm =CRM::created([
            'name'=>$request->name
        ]);
        return redirect()->route('crm.index')->with('success', 'Save Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CRM  $cRM
     * @return \Illuminate\Http\Response
     */
    public function show(CRM $cRM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CRM  $cRM
     * @return \Illuminate\Http\Response
     */
    public function edit(CRM $cRM)
    {
        // dd($cRM);


        return view('crm.create', compact('cRM'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CRM  $cRM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CRM $cRM)
    {
        //
        $request->validate([
            'name'=> 'required'
        ]);

        $cRM->name=$request->name;
        $cRM->save();

        return redirect()->route('crm.index')->with('success', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CRM  $cRM
     * @return \Illuminate\Http\Response
     */
    public function destroy(CRM $cRM)
    {
        $cRM->delete();

        return redirect()->route('crm.index')->with('success', 'Delete Successfully');
    }
}
