<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Email;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use App\Models\Street;
use App\Http\Controllers\ApiController;


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
        ->join('streets', 'clients.street_id', 'streets.id')
        ->join('districts', 'streets.district_id', 'districts.id')
        ->join('cities', 'districts.city_id', 'cities.id')
        ->join('states', 'cities.state_id', 'states.id')
        ->select(
            'clients.id',
            'clients.name',
            'clients.lastname',
            'clients.cpf',
            'clients.service',
            'clients.due_day',
            'clients.amount',
            'clients.num_convenio',
            'clients.address_num',
            'streets.street',
            'streets.cep',
            'districts.district',
            'cities.city',
            'states.uf',
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

        $state = new State;
        $city = new City;
        $client = new Client;
        $district = new District;
        $street = new Street;
        
        $state->firstOrCreate(['uf' => $request->uf]);
        $state_id = State::where('uf', $request->uf)->pluck('id')->first();

        $city->firstOrCreate(['city' => $request->city, 'state_id' => $state_id]);
        $city_id = City::where('city', $request->city)->pluck('id')->first();

        $district->firstOrCreate(['district' => $request->district, 'city_id' => $city_id]);
        $district_id = District::where('district', $request->district)->pluck('id')->first();

        $street->firstOrCreate(['street' => $request->street, 'cep' => $request->cep, 'district_id' => $district_id]);
        $street_id = Street::where('street', $request->street)->pluck('id')->first();

        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->cpf = $request->cpf;
        $client->service = $request->service;
        $client->due_day = $request->due_day;
        $client->amount = $request->amount;
        $client->num_convenio = $request->num_convenio;
        $client->address_num = $request->address_num;
        $client->street_id = $street_id;
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
        ->join('emails', 'emails.client_id', 'clients.id')->join('streets', 'clients.street_id', 'streets.id')
        ->join('districts', 'streets.district_id', 'districts.id')
        ->join('cities', 'districts.city_id', 'cities.id')
        ->join('states', 'cities.state_id', 'states.id')
        ->select(
            'clients.id',
            'clients.name',
            'clients.lastname',
            'clients.cpf',
            'clients.service',
            'clients.due_day',
            'clients.amount',
            'clients.num_convenio',
            'streets.cep',
            'clients.address_num',
            'streets.street',
            'districts.district',
            'cities.city',
            'states.uf',
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
    public function update(Request $request)
    {
        $data = $request->all();
        
        Client::findOrFail($request->id)->update($data);
        Phone::findOrFail($request->id)->update($data);
        Email::findOrFail($request->id)->update($data);
        Street::findOrFail($request->id)->update($data);
        District::findOrFail($request->id)->update($data);
        City::findOrFail($request->id)->update($data);
        State::findOrFail($request->id)->update($data);
        
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

        $boleto = new ApiController;

        $clients_hoje = Client::where('due_day', date('d'))
        ->join('phones', 'phones.client_id', 'clients.id')
        ->join('emails', 'emails.client_id', 'clients.id')->join('streets', 'clients.street_id', 'streets.id')
        ->join('districts', 'streets.district_id', 'districts.id')
        ->join('cities', 'districts.city_id', 'cities.id')
        ->join('states', 'cities.state_id', 'states.id')->get();

        /* echo date('d.m.Y', strtotime('now')) . "<br>";
        echo date('d.m.Y', strtotime('+7 days', strtotime('now'))) . "<br>"; */

        $boletos = [];
        /* $num_convenio, $data_emissao, $data_venc, $valor, $num_registro_cpf, $nome, $endereco, $cep, $cidade, $bairro, $uf, $tel, $email */
        foreach($clients_hoje as $cli){
            $boleto->registrarTeste(
                $cli->num_convenio,
                date('d.m.Y', strtotime('now')),
                date('d.m.Y', strtotime('+7days', strtotime('now'))),
                $cli->amount,
                $cli->cpf,
                $cli->name . " " . $cli->lastname,
                $cli->street . ", " . $cli->address_num,
                $cli->cep,
                $cli->city,
                $cli->district,
                $cli->uf,
                $cli->phone,
                $cli->email,
            );
        }
    }
}
