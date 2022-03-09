<table class="table table-condensed table-striped" id="abilities_list">
	<thead>

		@include('admin.bouncer.abilities.index.header')
		
	</thead>
	<tbody>
		@forelse ($abilities as $ability)

			@include('admin.bouncer.abilities.index.row',[
				'ability' => $ability
			])
        @empty
            <li>No hay habilidades registradas.</li>
        @endforelse
	</tbody>
</table>