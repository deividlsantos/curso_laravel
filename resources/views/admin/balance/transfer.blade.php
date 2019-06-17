@extends('adminlte::page')

@section('title', 'Transferir Saldo')

@section('content_header')
    <h1>Transferencia</h1>
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    	<li><a href="{{ route('admin.balance') }}">Saldo</a></li> 
    	<li><a href="">Transferencia</a></li>    	
    </ol>
@stop

@section('content')
     <div class="box">
    	<div class="box-header">
    		<h3>Fazer Transferencia (Informe o Recebedor)</h3>
    	</div>
    	<div class="box-body">
           @include('admin.includes.alerts')
    		<form method="POST" action="{{ route('confirm.transfer') }}">
    			{!! csrf_field() !!}
    			<div class="form-group">
    				<input type="text" name="sender" placeholder="Informe quem ira receber a transferencia" class="form-control">
    			</div>
    			<div class="form-group">
    				<button type="submit" class="btn btn-success">Proximo</button>
    			</div>
    		</form>
    	</div>
    </div>
@stop