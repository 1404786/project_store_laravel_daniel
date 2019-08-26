@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <a href=" {{route('balance.deposit')}}" class="btn btn-primary">Recarregar</a>

            @if ($amount > 0)
            
            <a href="{{route('balance.withdraw')}}" class="btn btn-danger">
            <i class="fas fa-money-check-alt" aria-hidden="true"></i>
            Sacar 
            </a>

            <a href="{{route('balance.transfer')}}" class="btn btn-info">
                <i class="fa fa-exchange" aria-hidden="true"></i>
            Transferir
            </a>

            @endif
        </div>
        @include('admin.includes.alerts')
        <div class="box-body">
            <div class="info-box bg-green">
                <span class="info-box-icon"></span>
                <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">R$ {{ number_format($amount, 2, '.', ' ') }}</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 20%"></div>
                </div>
                <span class="progress-description">
                    <a href="#" class="small-box-footer">Histórico</a>
                    
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

    </div>


@stop