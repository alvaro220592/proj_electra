@extends('layouts.main')

@section('title', 'Início')

@section('content')
    <h1>Clientes Cadastrados ({{ count($clients) }})<a href="{{ route('clients/cadastro-get') }}"><ion-icon name="add-outline" class="text-middle"></ion-icon></a></h1>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>CPF</th>
                    <th>Serviço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Dia Venc.</th>
                    <th>Valor</th>
                    <th>nº convênio</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>nº</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @if(count($clients) > 0)
                    @foreach($clients as $client)
                        <tr class="text-nowrap">
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->lastname }}</td>
                            <td>{{ $client->cpf }}</td>
                            <td>{{ $client->service }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->due_day }}</td>
                            <td>{{ $client->amount }}</td>
                            <td>{{ $client->num_convenio }}</td>
                            <td>{{ $client->cep }}</td>
                            <td>{{ $client->street }}</td>
                            <td>{{ $client->address_num }}</td>
                            <td>{{ $client->district }}</td>
                            <td>{{ $client->city }}</td>
                            <td>{{ $client->uf }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="clients/edit/{{ $client->id }}">
                                        <ion-icon name="refresh-outline" class='icons text-decoration-none'></ion-icon>
                                    </a>
                                    <form action="clients/delete/{{ $client->id }}" method="post" class=''>
                                        @csrf
                                        {{-- @method('DELETE') --}}
                                        <button type="submit" class="bg-transparent border-0">
                                            <ion-icon name="close-circle-outline" class='icons'></ion-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Área do envio das faturas --}}
    @if(count($clients))
    <div class="col-md-2">
        <button id="btn-enviar-faturas" class="btn btn-dark form-control">Enviar faturas</button>
        <div id="enviar-faturas-container">
            <p class="mt-4">Tem certeza?</p>

            <div class="row">
                <div class="col-md-6">
                    <form action="/clients/enviar" method="post">
                        @csrf
                        <button id="btn-sim" class="btn btn-dark form-control" type="submit">Sim</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <button id="btn-nao" class="btn btn-dark form-control">Não</button>
                </div>
            </div>
        </div>
    </div>
    {{ date('d') }}
   
    

    @endif
@endsection