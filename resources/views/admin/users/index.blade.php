@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">
            Usuarios
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $title }}</h1>

        @can('create',App\User::class)
        <p><small><a href="">Crear Usuario</a></small></p>
        @endcan

        @include('admin.users.index.table',[
            'users' => $users
        ])
    </div>
</div>
@endsection
