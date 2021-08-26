@extends('layouts.main')

@section('title', 'Início')

@section('content')
    <h1>Clientes Cadastrados <a href="{{ route('clients/cadastro-get') }}"><ion-icon name="add-outline" class="text-middle"></ion-icon></a></h1>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Dia Venc.</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($clients as $client)
                    <tr class="text-nowrap">
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->lastname }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->due_day }}</td>
                        <td>{{ $client->amount }}</td>
                        <td>
                            <ion-icon name="refresh-outline" class='icons'></ion-icon>
                            <ion-icon name="close-circle-outline" class='icons'></ion-icon>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
@endsection