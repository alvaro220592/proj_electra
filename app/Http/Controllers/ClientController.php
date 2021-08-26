<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Email;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::join('phones', 'phones.client_id', 'clients.id')
        ->join('emails', 'emails.client_id', 'clients.id')
        ->select(
            'clients.name',
            'clients.lastname',
            'clients.due_day',
            'clients.amount',
            'phones.phone',
            'emails.email'
        )->get();

        return view('index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client;
        

        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->due_day = $request->due_day;
        $client->amount = $request->amount;
        $client->save();
        
        $phone = new Phone;
        $phone->phone = $request->phone;
        $phone->client_id = $client->id;
        $phone->save();
        
        
        $email = new Email;
        $email->email = $request->email;
        $email->client_id = $client->id;
        $email->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
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
        //
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
    }
}
