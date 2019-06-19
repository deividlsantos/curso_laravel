@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="form-group">
		@if (auth()->user()->image != null)
			<img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="width: 150px; height: 180px; border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
		@endif
	</div>
@stop