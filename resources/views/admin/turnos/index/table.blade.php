<table class="table table-condensed table-striped" id="turnos_list">
	<thead>

		@include('admin.turnos.index.header')
		
	</thead>
	<tbody>
		@foreach ($turnos as $turno)

			@include('admin.turnos.index.row',[
				'turno' => $turno
			])
		@endforeach
	</tbody>
</table>