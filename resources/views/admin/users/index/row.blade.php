<tr class="hover-effect" data-id="{{ $user->id }}" data-href="{{ route('users.show',$user) }}">
	<td class="text-center">
		<small class="text-muted">{{ $loop->iteration }}</small>
	</td>
	
	<td class="text-center">
		<small>{{ $user->name }}</small>
	</td>
	<td class="text-center">
		<small>{{ $user->email }}</small>
	</td>
	<td class="text-center">
		<small>{{ $user->habilitado }}</small>
	</td>
	<td class="text-center">
		<small>{{ optional($user->centro)->full_name }}</small>
	</td>

	<td class="text-center">
		<a href="{{ route('users.show',$user) }}" class="text-info" data-toggle="tooltip" title="Ver los datos del usuario.">
			<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
			<small>IR</small>
		</a>
	</td>
</tr>