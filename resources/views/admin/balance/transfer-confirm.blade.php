@extends('adminlte::page')

@section('title', 'Confirmar Transferir Saldo')

@section('content_header')
    <h1>Confirmar Transferencia</h1>
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    	<li><a href="{{ route('admin.balance') }}">Saldo</a></li> 
    	<li><a href="">Transferencia</a></li>
        <li><a href="">Conf-Transfer</a></li>     	
    </ol>
@stop

@section('content')
     <div class="box">
    	<div class="box-header">
    		<h3>Confirmar Transferir Saldo</h3>
    	</div>
    	<div class="box-body">
           @include('admin.includes.alerts')

           <p><strong>Recebedor: </strong>{{ $sender->name }}</p>
           <p><strong>Seu Saldo Atual: </strong>R$ {{ number_format($balance->amount, 2, ',', '') }}</p>

    		<form method="POST" action="{{ route('transfer.store') }}">
    			{!! csrf_field() !!}
                <input type="hidden" name="sender_id" value="{{ $sender->id }}">

    			<div class="form-group">
    				<input type="text" name="value" placeholder="Valor:" class="form-control">
    			</div>
    			<div class="form-group">
    				<button type="submit" class="btn btn-success">Finalizar</button>
    			</div>
    		</form>
    	</div>
    </div>
@stop