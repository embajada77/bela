@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('agendas.index') }}">
            Agendas
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ $title }}</h1>

        @can('create',App\Agenda::class)
        <p><small><a href="">Crear Agenda</a></small></p>
        @endcan

        @include('admin.agendas.index.table',[
            'agendas' => $agendas
        ])
    </div>
</div>
@endsection
