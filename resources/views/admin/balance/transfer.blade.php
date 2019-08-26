@extends('adminlte::page')

@section('title', 'Nova transferencia')

@section('content_header')
    <h1>Fazer transferencia</h1>
    <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Saldo</a></li>
        <li><a href="#">Depositar</a></li>
        <li><a href="#">Transferir</a></li>
    </ol>
@stop

@section('content')
    <p>#form_transfer</p>
    <div class="box">
        <div class="box-header">
            <h3>Fazer transferencia (Informe o recebedor)<h3>
            <p>É usado para salvar um token, pelo que parece isso é exigencia do laravel</p>
        </div>

        <div class="box-body">
            @include('admin.includes.alerts')

            <form method="POST" action="{{ route('transfer.confirm') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input type="text" name="sender" placeholder="Nome ou e-mail" class="form-control"> 
                </div>
                <div class="form-group">
                                <i class="fas fa-money-check-alt"></i>

                    <button  type="submit" class="btn btn-success">Próxima etapa</button>
                </div>
                <div class="form-group">
                </div>
            </form>

        </div>

    </div>


@stop