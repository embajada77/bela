@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('agendas.index') }}">
            Agendas
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('agendas.show',$agenda) }}">
            {{ $agenda->full_name }}
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <h1>
                    <strong>{{ $agenda->centro->full_name }}</strong> 
                </h1>
                <h5>
                    {{ $agenda->dia }}
                    <span> | {{ $agenda->hora }} - {{ $agenda->hora_fin }}</span>
                    <span> | <strong>{{ $agenda->estado->full_name }}</strong></span>
                </h5>
            </div>
            <div class="col-md-3">
                <small>
                    <ul>
                        <li>Comisión: {{ formatoPorcentaje($agenda->comision_armado_agenda) }}</li>
                        <li>Plus: {{ formatoMoneda($agenda->plus_armado_agenda) }}</li>
                    </ul>
                    <ul>
                        <li>Comisión: {{ formatoPorcentaje($agenda->comision_armado_agenda) }}</li>
                        <li>Plus: {{ formatoMoneda($agenda->plus_armado_agenda) }}</li>
                    </ul>
                </small>
            </div>
        </div>

        @can('update',$agenda)
        <p><small><a href="{{ route('agendas.edit',$agenda) }}">Editar Agenda</a></small></p>
        @endcan
        
        <div class="row">
            <div class="col-md-12">
                @include('admin.turnos.index.table',[
                    'turnos' => $agenda->turnos
                ])
            </div>
        </div>
    </div>
</div>
@endsection
