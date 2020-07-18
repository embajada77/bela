<table class="table table-condensed table-striped" id="agendas_list">
	<thead>

		@include('admin.agendas.index.header')
		
	</thead>
	<tbody>
		@foreach ($agendas as $agenda)

			@include('admin.agendas.index.row',[
				'agenda' => $agenda
			])
		@endforeach
	</tbody>
</table>