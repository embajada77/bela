@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                    @forelse ($users as $user)
                        <li>
                            {{ $user->name }} <small>{{ $user->email }} <a href="{{ route('users.show',$user) }}">Detalles</a></small>
                        </li>
                    @empty
                        <li>No hay usuarios Registrados.</li>
                    @endforelse
                    </ul>

                    <hr>

                    <a href="{{ route('home') }}"><small>Home</small></a>
                    /
                    <a href="{{ route('users.index') }}"><small>Usuarios</small></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
