<table class="table table-condensed table-striped" id="abilities_list">
	<thead>

		@include('admin.users.show.abilities.header')
		
	</thead>
	<tbody>
		@foreach ($user->abilities as $ability)
			@include('admin.users.show.abilities.row',[
				'role_name' => '',
				'ability' => $ability
			])
        @endforeach
		@foreach ($user->roles as $role)
			@foreach ($role->abilities as $ability)
				@include('admin.users.show.abilities.row',[
					'role_name' => $role->name,
					'ability' => $ability
				])
	        @endforeach
        @endforeach
	</tbody>
</table>