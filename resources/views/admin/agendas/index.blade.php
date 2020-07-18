@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ $title }}</h1>

            @php
                $response = Gate::inspect('create',App\Agenda::class); 
                if ($response->allowed()) {
                    // The action is authorized...
                } else {
                    echo $response->message();
                }
            @endphp

            @can('create',App\Agenda::class)
            <p><small><a href="">Crear Agenda</a></small></p>
            @else
            @endcan

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

			@include('admin.agendas.index.table',[
				'agendas' => $agendas
			])

            <hr>

            <a href="{{ route('home') }}"><small>Home</small></a>
            /
            <a href="{{ route('agendas.index') }}"><small>Agendas</small></a>
        </div>
    </div>
</div>
@endsection
