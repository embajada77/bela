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

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <ul>
                                <li>Centro: <strong>{{ $agenda->centro->full_name }}</strong></li>
                                <li>Inicio: {{ $agenda->fecha_inicio }}</li>
                                <li>Fin: {{ $agenda->fecha_fin }}</li>
                                <li>Estado: <strong>{{ $agenda->estado->full_name }}</strong></li>
                                <li>Turnos: {{ $agenda->turnos->count() }}</li>
                            </ul>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <ul>
                                <li><strong>Agenda</strong></li>
                                <li>Comisión por turnos: {{ $agenda->comision_diaria }}</li>
                                <li>Plus diario: {{ $agenda->plus_diario }}</li>
                            </ul>
                            <ul>
                                <li><strong>Armado agenda</strong></li>
                                <li>Comisión por turnos: {{ $agenda->comision_armado_agenda }}</li>
                                <li>Plus: {{ $agenda->plus_armado_agenda }}</li>
                            </ul>
                        </div>
                    </div>

                    <hr>

					@include('admin.turnos.index.table',[
						'turnos' => $agenda->turnos
					])

                    <hr>

                    <a href="{{ route('home') }}"><small>Home</small></a>
                    /
                    <a href="{{ route('agendas.index') }}"><small>Agendas</small></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
