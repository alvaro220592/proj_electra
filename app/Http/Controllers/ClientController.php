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
            'clients.id',
            'clients.name',
            'clients.lastname',
            'clients.cpf',
            'clients.service',
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
        $client->cpf = $request->cpf;
        $client->service = $request->service;
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
    public function edit($id)
    {
        $client = Client::where('clients.id', $id)
        ->join('phones', 'phones.client_id', 'clients.id')
        ->join('emails', 'emails.client_id', 'clients.id')
        ->select(
            'clients.id',
            'clients.name',
            'clients.lastname',
            'clients.cpf',
            'clients.service',
            'clients.due_day',
            'clients.amount',
            'phones.phone',
            'emails.email'
        )->first();

        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->cpf = $request->cpf;
        $client->service = $request->service;
        $client->due_day = $request->due_day;
        $client->amount = $request->amount;
        $client->update();

        $phone = Phone::where('client_id', $id)->first();
        $phone->phone = $request->phone;
        $phone->update();

        $email = Email::where('client_id', $id)->first();
        $email->email = $request->email;
        $email->update();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return redirect('/');
    }

    public function enviar(){

        $clients_hoje = Client::where('due_day', date('d'))->get();

        echo date('d.m.Y', strtotime('now')) . "<br>";
        echo date('d.m.Y', strtotime('+7 days', strtotime('now'))) . "<br>";

        foreach($clients_hoje as $cli){
            echo 
            "Nome: $cli->name $cli->lastname<br>
            CPF: $cli->cpf
            <hr>";
        }
        //dd($clients_hoje);
    }
}
