<tr class="hover-effect" data-id="{{ $role->id }}">
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<small>{{ $role->name }}</small>
	</td>
	<td class="text-center">
		<small>{{ $role->title }}</small>
	</td>
	<td class="text-center">
		<small>{{ $role->level }}</small>
	</td>
	<td class="text-center">
		<small>{{ $role->scope }}</small>
	</td>

	<td class="text-center">
		{{-- <a href="{{ route('roles.show',$role) }}" class="text-info" data-toggle="tooltip" title="Ver los datos del usuario.">
			<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			<small>IR</small>
		</a> --}}
	</td>
</tr>