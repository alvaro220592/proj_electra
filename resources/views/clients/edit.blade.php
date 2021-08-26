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

            <div class="col-md-6">
                <input type="submit" value="Salvar" class="btn btn-dark form-control mt-2">
            </div>

        </div>

    </form>
    
@endsection