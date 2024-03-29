@extends('site.layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<h1>Meu Perfil</h1>

@include('admin.includes.alerts')

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<div class="form-group">
		<label for="name">Nome</label>
		<input type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Nome" class="form-control">
	</div>
	<div class="form-group">
		<label for="email">E-mail</label>
		<input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="E-mail" class="form-control">
	</div>
	<div class="form-group">
		<label for="password">Senha</label>
		<input type="password" name="password" placeholder="Senha" class="form-control">
	</div>
	<div class="form-group">
		@if (auth()->user()->image != null)
			<img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->name }}" style="max-width: 15%;">
		@endif
		<input type="file" name="image" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-info">Atualizar Perfil</button>
	</div>
</form>

@endsection