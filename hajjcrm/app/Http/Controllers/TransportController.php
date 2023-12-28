<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transport;

class TransportController extends Controller
{
    public function index()
    {
        $transports=Transport::all();
        return view('transport.index', compact('transports'));
    }

    public function create()
    {
        // dd('ok');
        return view('transport.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
            'sightcost'=>'required',
            'pax'=>'required',
            'paxsight'=>'required',
        ]);
        $transport = new Transport();
        $transport->name = $request->name;
        $transport->cost = $request->cost;
        $transport->sightcost = $request->sightcost;
        $transport->pax = $request->pax;
        $transport->paxsight = $request->paxsight;
        $transport->save();

        return redirect()->route('transport.index'); 
    }

    public function edit(Transport $transport)
    {
        return view('transport.edit', compact('transport'));
    }

    public function update(Request $request, Transport $transport)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required',
            'cost'=>'required',
            'sightcost'=>'required',
            'pax'=>'required',
            'paxsight'=>'required',
        ]);
        $transport->name = $request->name;
        $transport->cost = $request->cost;
        $transport->sightcost = $request->sightcost;
        $transport->pax = $request->pax;
        $transport->paxsight = $request->paxsight;
        $transport->save();

        return redirect()->route('transport.index');
    }

    public function destroy(Transport $transport)
    {
        $transport->delete();
        return redirect()->route('transport.index');
    }
}
