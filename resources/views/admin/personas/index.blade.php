@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('personas.index') }}">
            Personas
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $title }}</h1>

        @can('create',App\Persona::class)
        <p><small><a href="">Crear Persona</a></small></p>
        @endcan

        @include('admin.personas.index.table',[
            'personas' => $personas
        ])
    </div>
</div>
@endsection
