<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CRM;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $client=Client::all();
        return view('client.index', compact( 'client'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $crm=CRM::all();
        $source=Source::all();
       return view('client.create', compact('crm', 'source'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFull(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'groupName'=>'required',
            'groupNo'=>'required',
            'givenName'=>'required',
            'surName'=>'required',
            'passportNo'=>'required',
            'passportType'=>'required',
            'issuingCountry'=>'required',
            'ppIssueDate'=>'required',
            'ppExpiryDate'=>'required',
            'dateofBirth'=>'required',
            'Mobile'=>'required',
            'emergencyMobile'=>'required',
            'email'=>'required|email',
            'nosofPerson'=>'required',
            'tourMonth'=>'required',
            'status'=>'required',
            'queryDetails'=>'required',
            'note'=>'required',
            'source_id'=>'required',
            'crm_id'=>'required'
        ]);
        Client::create([
            'groupName'=>$request->groupName,
            'groupNo'=>$request->groupNo,
            'givenName'=>$request->givenName,
            'surName'=>$request->surName,
            'passportNo'=>$request->passportNo,
            'passportType'=>$request->passportType,
            'issuingCountry'=>$request->issuingCountry,
            'ppIssueDate'=>$request->ppIssueDate,
            'ppExpiryDate'=>$request->ppExpiryDate,
            'dateofBirth'=>$request->dateofBirth,
            'Mobile'=>$request->Mobile,
            'emergencyMobile'=>$request->emergencyMobile,
            'email'=>$request->email,
            'nosofPerson'=>$request->nosofPerson,
            'tourMonth'=>$request->tourMonth,
            'status'=>$request->status,
            'queryDetails'=>$request->queryDetails,
            'note'=>$request->note,
            'source_id'=>$request->source_id,
            'crm_id'=>$request->crm_id,
            'user_id'=>Auth::user()->id,
        ]);

        return redirect()->route('client.index');
    }

    public function store(Request $request){
        $request->validate([

            'givenName'=>'required',

            'Mobile'=>'required',
            'email'=>'required|email',
            'nosofPerson'=>'required',
            'tourMonth'=>'required',
            'queryDetails'=>'required',
            'note'=>'required',
            'source_id'=>'required',
            'crm_id'=>'required'
        ]);
        Client::create([

            'givenName'=>$request->givenName,

            'Mobile'=>$request->Mobile,
            'email'=>$request->email,
            'nosofPerson'=>$request->nosofPerson,
            'tourMonth'=>$request->tourMonth,
            'queryDetails'=>$request->queryDetails,
            'note'=>$request->note,
            'source_id'=>$request->source_id,
            'crm_id'=>$request->crm_id,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $crm=CRM::all();
        $source=Source::all();
       return view('client.create', compact('crm',  'source', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([

            'givenName'=>'required',

            'Mobile'=>'required',
            'email'=>'required|email',
            'nosofPerson'=>'required',
            'tourMonth'=>'required',
            'queryDetails'=>'required',
            'note'=>'required',
            'source_id'=>'required',
            'crm_id'=>'required'
        ]);


        $client->givenName = $request->givenName;


        $client->Mobile = $request->Mobile;
        $client->email = $request->email;
        $client->nosofPerson = $request->nosofPerson;
        $client->tourMonth = $request->tourMonth;
        $client->queryDetails = $request->queryDetails;
        $client->note = $request->note;
        $client->source_id = $request->source_id;
        $client->crm_id = $request->crm_id;
        $client->user_id = Auth::user()->id;

        $client->save();

        return redirect()->route('client.index');
    }

    public function updateFull(Request $request, Client $client)
    {
        $request->validate([
            'groupName'=>'required',
            'groupNo'=>'required',
            'givenName'=>'required',
            'surName'=>'required',
            'passportNo'=>'required',
            'passportType'=>'required',
            'issuingCountry'=>'required',
            'ppIssueDate'=>'required',
            'ppExpiryDate'=>'required',
            'dateofBirth'=>'required',
            'Mobile'=>'required',
            'emergencyMobile'=>'required',
            'email'=>'required',
            'nosofPerson'=>'required',
            'tourMonth'=>'required',
            'status'=>'required',
            'queryDetails'=>'required',
            'note'=>'required',
            'source_id'=>'required',
            'crm_id'=>'required'
        ]);

        $client->groupName = $request->groupName;
        $client->groupNo = $request->groupNo;
        $client->givenName = $request->givenName;
        $client->surName = $request->surName;
        $client->passportNo = $request->passportNo;
        $client->passportType = $request->passportType;
        $client->issuingCountry = $request->issuingCountry;
        $client->ppIssueDate = $request->ppIssueDate;
        $client->ppExpiryDate = $request->ppExpiryDate;
        $client->dateofBirth = $request->dateofBirth;
        $client->Mobile = $request->Mobile;
        $client->emergencyMobile = $request->emergencyMobile;
        $client->email = $request->email;
        $client->nosofPerson = $request->nosofPerson;
        $client->tourMonth = $request->tourMonth;
        $client->status = $request->status;
        $client->queryDetails = $request->queryDetails;
        $client->note = $request->note;
        $client->source_id = $request->source_id;
        $client->crm_id = $request->crm_id;
        $client->user_id = Auth::user()->id;

        $client->save();

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
        $client->delete();
        return redirect()->route('client.index');
    }
}
