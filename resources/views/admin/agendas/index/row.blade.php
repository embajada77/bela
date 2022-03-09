<tr class="hover-effect" data-id="{{ $agenda->id }}" data-href="{{ route('agendas.show',$agenda) }}">
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<small>{{ $agenda->dia }}</small>
	</td>
	<td class="text-center">
		@can('view',$agenda)
			<small>{{ $agenda->hora }}</small>
		@else
			<small data-toggle="tooltip" title="{{ Gate::inspect('view',$agenda)->message() }}">?</small>
		@endcan
	</td>
	<td class="text-center">
		@can('view',$agenda)
			<small>
				{{ $agenda->hora_fin }}
				@if ($agenda->dias_duracion > 0) 
					<sup class="text-danger" data-toggle="tooltip" title="La agenda termina {{ $agenda->dias_duracion }} días despues.">
						<strong>
							+{{ $agenda->dias_duracion }}
						</strong>
					</sup>
				@endif
			</small>
		@else
			<small data-toggle="tooltip" title="{{ Gate::inspect('view',$agenda)->message() }}">?</small>
		@endcan
	</td>
	<td class="text-center">
		<small>{{ $agenda->estado->full_name }}</small>
	</td>
	<td class="text-left">
		<strong>{{ $agenda->centro->full_name }}</strong>
	</td>
	<td class="text-center">
		@can('view',$agenda)
			<strong>{{ $agenda->turnos->count() }}</strong>
		@else
			<small data-toggle="tooltip" title="{{ Gate::inspect('view',$agenda)->message() }}">?</small>
		@endcan
	</td>

	<td class="text-center">
		@can('view',$agenda)
			<a href="{{ route('agendas.show',$agenda) }}" class="text-info" data-toggle="tooltip" title="Ver los datos de la agenda.">
				<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
				<small>IR</small>
			</a>
		@else
			<small data-toggle="tooltip" title="{{ Gate::inspect('view',$agenda)->message() }}">?</small>
		@endcan
	</td>
</tr>