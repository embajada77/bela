<tr class="hover-effect" data-id="{{ $ability->id }}">
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<small>{{ $role_name }}</small>
	</td>
	<td class="text-center">
		<small>{{ $ability->name }}</small>
	</td>
	<td class="text-center">
		<small>{{ $ability->title }}</small>
	</td>
	<td class="text-center">
		<small>{{ $ability->entity_id }}</small>
	</td>
	<td class="text-center">
		<small>{{ $ability->entity_type }}</small>
	</td>
	<td class="text-center">
		<small>{{ $ability->only_owned }}</small>
	</td>
	<td class="text-center">
		{{-- <small>{{ $$ability->options }}</small> --}}
	</td>
	<td class="text-center">
		<small>{{ $ability->scope }}</small>
	</td>

	<td class="text-center">
		{{-- <a href="{{ route('roles.show',$role) }}" class="text-info" data-toggle="tooltip" title="Ver los datos del usuario.">
			<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			<small>IR</small>
		</a> --}}
	</td>
</tr>