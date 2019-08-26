@extends('adminlte::page')

@section('title', 'Confirmar transferencia')

@section('content_header')
    <h1>Confirmar transferência</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Depositar</a></li>
        <li><a href="#">Transferir</a></li>
        <li><a href="#">Confirmação</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar transferencia Saldo<h3>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')
                        
            <p><strong>Recebedor: </strong>{{ $sender->name }}</p>
            <p><strong>Saldo disponível: </strong>R$ {{ number_format($balance->amount, 2, '.', ' ') }}</p>

            <form method="POST" action="{{ route('transfer.store') }}">
                {!! csrf_field() !!}
    
                <input type="hidden" name="sender_id" placeholder="Valor" value="{{$sender->id}}" class="form-control">

                <div class="form-group">
                    <input type="text" name="value" placeholder="Valor:" class="form-control"> 
                </div>
                <div class="form-group">
                    <button  type="submit" class="btn btn-success">Transferir</button>
                </div>
                <div class="form-group">
                </div>
            </form>

        </div>

    </div>


@stop