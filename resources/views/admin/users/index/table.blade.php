<table class="table table-condensed table-striped" id="users_list">
	<thead>

		@include('admin.users.index.header')
		
	</thead>
	<tbody>
		@forelse ($users as $user)

			@include('admin.users.index.row',[
				'user' => $user
			])
        @empty
            <li>No hay usuarios Registrados.</li>
        @endforelse
	</tbody>
</table>