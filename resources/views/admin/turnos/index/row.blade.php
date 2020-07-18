<tr class="hover-effect" data-id="{{ $turno->id }}" data-href="{{ route('turnos.show',$turno) }}">
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<small class="text-muted">{{ $turno->centro->full_name }}</small>
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $turno->fecha_inicio }}</small>
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $turno->fecha_fin }}</small>
	</td>
	<td class="text-center">
		<small>{{ optional($turno->estado)->full_name }}</small>
	</td>
	<td class="text-center">
		<strong>{{ optional($turno->paciente)->full_name }}</strong>
	</td>
	<td class="text-center">
		<small>{{ $turno->tratamientos->implode('full_name',', ') }}</small>
	</td>

	<td class="text-center">
		<a href="{{ route('turnos.show',$turno) }}" class="text-info" data-toggle="tooltip" title="Click para ver los datos del turno.">
			<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			<small>IR</small>
		</a>
	</td>
</tr>