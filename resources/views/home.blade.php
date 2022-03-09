@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <hr>

                    <a href="{{ route('home') }}"><small>Home</small></a>
                    <br>
                    @admin / <a href="{{ route('users.index') }}"><small>Usuarios</small></a> @endadmin
                    @owner / <a href="{{ route('geo.paises.index') }}"><small>Paises</small></a> @endowner
                    @owner / <a href="{{ route('personas.index') }}"><small>Personas</small></a> @endowner
                    / <a href="{{ route('agendas.index') }}"><small>Agendas</small></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
