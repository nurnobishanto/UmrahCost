<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuportCostRequest;
use App\Http\Requests\UpdateSuportCostRequest;
use Illuminate\Http\Request;
use App\Models\SuportCost;

class SuportCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suportcosts=SuportCost::all();
        return view('support-cost.index', compact('suportcosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('ok');
        return view('support-cost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSuportCostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
        ]);
        $suportCost = new SuportCost();
        $suportCost->name = $request->name;
        $suportCost->cost = $request->cost;

        $suportCost->save();

        return redirect()->route('supportcost.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuportCost  $suportCost
     * @return \Illuminate\Http\Response
     */
    public function show(SuportCost $suportCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuportCost  $suportCost
     * @return \Illuminate\Http\Response
     */
    public function edit(SuportCost $suportCost)
    {
        // dd('ok');
        return view('support-cost.create', compact('suportCost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuportCostRequest  $request
     * @param  \App\Models\SuportCost  $suportCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuportCost $suportCost)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
        ]);
        $suportCost->name = $request->name;
        $suportCost->cost = $request->cost;

        $suportCost->save();

        return redirect()->route('supportcost.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuportCost  $suportCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuportCost $suportCost)
    {
        $suportCost->delete();
        return redirect()->route('supportcost.index');
    }
}
