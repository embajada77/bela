<tr data-id="{{ $persona->id }}" class='clickable-row hover-effect' data-href='{{ route('personas.show',$persona) }}'>
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>

	<td class="text-center">
		<small class="text-muted">{{ $persona->genero->nombre }}</small>
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $persona->full_documento }}</small>
	</td>
	<td class="text-left">
		{{ $persona->inverse_full_name }}
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $persona->nacimiento->format('d-m-Y') }}</small>
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $persona->edad }}</small>
	</td>
	<td class="text-center">
		<small class="text-muted">{{ $persona->nacionalidad }}</small>
	</td>

	<td class="text-center">
		@can('view',$persona)
			<a href="{{ route('personas.show',$persona) }}" class="text-info" data-toggle="tooltip" title="Ver los datos de la persona.">
				<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
				<small>IR</small>
			</a>
		@else
			<small data-toggle="tooltip" title="{{ Gate::inspect('view',$persona)->message() }}">?</small>
		@endcan
	</td>
</tr>