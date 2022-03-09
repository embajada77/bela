<table class="table table-condensed table-striped" id="personas_list">
	<thead>

		@include('admin.personas.index.header')
		
	</thead>
	<tbody>
		@foreach ($personas as $persona)

			@include('admin.personas.index.row',[
				'persona' => $persona
			])
		@endforeach
	</tbody>
</table>