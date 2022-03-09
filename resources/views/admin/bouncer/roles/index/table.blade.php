<table class="table table-condensed table-striped" id="roles_list">
	<thead>

		@include('admin.bouncer.roles.index.header')
		
	</thead>
	<tbody>
		@forelse ($roles as $role)

			@include('admin.bouncer.roles.index.row',[
				'role' => $role
			])
        @empty
            <li>No hay roles Registrados.</li>
        @endforelse
	</tbody>
</table>