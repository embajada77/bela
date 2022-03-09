@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">
            Usuarios
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users.show',$user) }}">
            {{ $user->name }}
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    <strong>{{ $user->name }}</strong> 
                </h1>
                <h5>
                    @if ($user->habilitado) Habilitado @else Deshabilitado @endif
                    <span> | <strong>{{ $user->email }}</strong></span>
                </h5>
            </div>
        </div>

        @can('update',$user)
        <p><small><a href="{{ route('users.edit',$user) }}">Editar usuario</a></small></p>
        @endcan

        <hr>

        <h5>Roles</h5>
        
        <div class="row">
            <div class="col-md-12">
                @include('admin.bouncer.roles.index.table',[
                    'roles' => $user->roles
                ])
            </div>
        </div>

        <hr>

        @include('admin.users.show.abilities')
    </div>
</div>
@endsection
