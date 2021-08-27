@extends('layouts.main')

@section('title', 'Editar')

@section('content')
    <h1>Editando Cliente</h1>

    <form method="post" action="/clients/update/{{ $client->id }}" class="form-group">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ $client->name }}">
            </div>

            <div class="col-md-3">
                <label for="lastname">Sobrenome</label>
                <input type="text" name="lastname" class="form-control" value="{{ $client->lastname }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{ $client->cpf }}">
            </div>

            <div class="col-md-3">
                <label for="service">Serviço</label>
                <input type="text" name="service" class="form-control" value="{{ $client->service }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="phone">Telefone</label>
                <input type="text"  name="phone" class="form-control" value="{{ $client->phone }}">
            </div>

            <div class="col-md-3">
                <label for="email">Email</label>
                <input type="text"  name="email" class="form-control" value="{{ $client->email }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="due_day">Dia venc. Fatura</label>
                <input type="number"  name="due_day" max="30" min="0" class="form-control" value="{{ $client->due_day }}">
            </div>

            <div class="col-md-3">
                <label for="amount">Valor</label>
                <input type="number"  name="amount" class="form-control" min="0" value="{{ $client->amount }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="num_convenio">Num convênio</label>
                <input type="text"  name="num_convenio" class="form-control" value="{{ $client->num_convenio }}">
            </div>

            <div class="col-md-3">
                <label for="cep">CEP</label>
                <input type="text"  name="cep" class="form-control" value="{{ $client->cep }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="street">Logradouro</label>
                <input type="text"  name="street" class="form-control" value="{{ $client->street }}">
            </div>

            <div class="col-md-3">
                <label for="address_num">Nº</label>
                <input type="text"  name="address_num" class="form-control" value="{{ $client->address_num }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="district">Bairro</label>
                <input type="text"  name="district" class="form-control" value="{{ $client->district }}">
            </div>

            <div class="col-md-3">
                <label for="city">Cidade</label>
                <input type="text"  name="city" class="form-control" value="{{ $client->city }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="uf">UF</label>
                <input type="text"  name="uf" class="form-control" value="{{ $client->uf }}">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <input type="submit" value="Salvar" class="btn btn-dark form-control mt-2">
            </div>

        </div>

    </form>

    <div class="row">

        <div class="col-md-6">
            <a href="/" class="btn btn-dark form-control mt-2">Cancelar</a>
        </div>

    </div>
    
@endsection