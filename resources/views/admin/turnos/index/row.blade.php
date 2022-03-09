<tr class="hover-effect" data-id="{{ $turno->id }}" data-href="{{ route('turnos.show',$turno) }}">
	<td class="text-center">
		<small>{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<strong>{{ $turno->hora }}</strong>
	</td>
	<td class="text-center">
		<small>
			{{ $turno->hora_fin }}
			@if ($turno->dias_duracion > 0) 
				<sup class="text-danger" data-toggle="tooltip" title="El turno termina {{ $turno->dias_duracion }} días despues.">
					<strong>
						+{{ $turno->dias_duracion }}
					</strong>
				</sup>
			@endif
		</small>
	</td>
	<td class="text-center">
		<small>{{ $turno->estado->full_name }}</small>
	</td>
	<td class="text-left">
		<strong>{{ $turno->paciente->attrPersona('inverse_minimal_name') }}</strong>
	</td>
	<td class="text-left">
		<small>{{ $turno->tratamientos->implode('full_name',', ') }}</small>
	</td>

	<td class="text-center">
		<a href="{{ route('turnos.show',$turno) }}" class="text-info" data-toggle="tooltip" title="Click para ver los datos del turno.">
			<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			<small>IR</small>
		</a>
	</td>
</tr>