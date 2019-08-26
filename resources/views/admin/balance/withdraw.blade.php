@extends('adminlte::page')

@section('title', 'Sacar')

@section('content_header')
    <h1>Fazer saque</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Sacar</a></li>
    </ol>
@stop

@section('content')
    <p>#form_deposit</p>
    <div class="box">
        <div class="box-header">

            <h3>Fazer saque<h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')


            <form method="POST" action="{{ route('withdraw.store') }}">
                // É usado para salvar um token, pelo que parece isso é exigencia do laravel
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="value" placeholder="Valor de saque" class="form-control"> 
                </div>
                <div class="form-group">
                <i class="fas fa-money-check-alt"></i>
                    <button  type="submit" class="btn btn-success">Sacar</button>
                </div>
                <div class="form-group">
                </div>
            </form>

        </div>

    </div>


@stop