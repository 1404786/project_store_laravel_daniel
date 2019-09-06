@extends('adminlte::page')

@section('title', 'Nova Recargar')

@section('content_header')
    <h1>Fazer recarga</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Depositar</a></li>
    </ol>
@stop

@section('content')
    <p>#form_deposit</p>
    <div class="box">
        <div class="box-header">
            <h3>Fazer recarga<h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')


            <form method="POST" action="{{ route('deposit.store') }}">
                // É usado para salvar um token, pelo que parece isso é exigencia do laravel
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="value" autofocus placeholder="Valor recarga" class="form-control"> 
                </div>
                <div class="form-group">
                    <button  type="submit" class="btn btn-success">Regarregar</button>
                </div>
                <div class="form-group">
                </div>
            </form>

        </div>

    </div>


@stop