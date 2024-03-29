@extends('adminlte::page')

@section('title', 'Saque')

@section('content_header')
    <h1>Relizar Saque</h1>
    <ol class="breadcrumb">
    	<li><a href="{{ route('admin.home') }}">Dashboard</a></li>
    	<li><a href="{{ route('admin.balance') }}">Saldo</a></li> 
    	<li><a href="">Sacar</a></li>    	
    </ol>
@stop

@section('content')
     <div class="box">
    	<div class="box-header">
    		<h3>Fazer Saque</h3>
    	</div>
    	<div class="box-body">
           @include('admin.includes.alerts')
    		<form method="POST" action="{{ route('withdraw.store') }}">
    			{!! csrf_field() !!}
    			<div class="form-group">
    				<input type="text" name="value" placeholder="Valor a Sacar" class="form-control">
    			</div>
    			<div class="form-group">
    				<button type="submit" class="btn btn-success">Finalizar</button>
    			</div>
    		</form>
    	</div>
    </div>
@stop