@extends('layouts.main')

@section('title', 'Início')

@section('content')
    <h1>Novo cliente</h1>

    <form method="post" action="{{ route('clients/store') }}" class="form-group">
        @csrf

        <div class="row">

            <div class="col-md-3">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="col-md-3">
                <label for="lastname">Sobrenome</label>
                <input type="text" name="lastname" class="form-control">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{ old('cpf') }}">
            </div>

            <div class="col-md-3">
                <label for="service">Serviço</label>
                <input type="text" name="service" class="form-control">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="phone">Telefone</label>
                <input type="text"  name="phone" class="form-control">
            </div>

            <div class="col-md-3">
                <label for="email">Email</label>
                <input type="text"  name="email" class="form-control">
            </div>

        </div>

        <div class="row">

            <div class="col-md-3">
                <label for="due_day">Dia venc. Fatura</label>
                <input type="number"  name="due_day" max="30" min="0" class="form-control">
            </div>

            <div class="col-md-3">
                <label for="amount">Valor</label>
                <input type="number"  name="amount" class="form-control" min="0">
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <input type="submit" value="Cadastrar" class="btn btn-dark form-control mt-2">
            </div>

        </div>

    </form>
    
@endsection