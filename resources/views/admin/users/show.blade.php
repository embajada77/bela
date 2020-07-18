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
                        <li>{{ $user->name }}</li>
                        <li>{{ $user->email }}</li>
                    </ul>

                    <hr>
                    
                    <a href="{{ route('home') }}"><small>Home</small></a>
                    /
                    <a href="{{ route('users.index') }}"><small>Usuarios</small></a>
                    /
                    <a href="{{ route('users.show',$user) }}"><small>Detalle</small></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
