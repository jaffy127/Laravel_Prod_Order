<h3>Listado de CLientes</h3>
<table class="table table-hover table-bordered datatable" id="dtBasicExample">
	<thead class="thead-dark">
		<tr>
			<th >Nombre</th>
			<th >Dirección</th>	
			<th >Email</th>
			<th >Moneda</th>
		</tr>
	</thead>
	<tbody>
		
			@if (!empty($result_cliente) && !$result_cliente->isEmpty())				
				@foreach ($result_cliente as $cliente)
					
					<tr>
						<th scope="row">							
							<p>{{ !empty($cliente->nombre_cliente) ? $cliente->nombre_cliente : ''}}</p>
						</th>

						<td>
							{{ !empty($cliente->direccion) ? $cliente->direccion : ''}}
						</td>

						<td>
							{{ !empty($cliente->email) ? $cliente->email : ''}}
						</td>

						<td>
							{{ !empty($cliente->moneda) ? $cliente->moneda : ''}}
						</td>
					</tr>

				@endforeach
			@endif
		
	</tbody>
</table>

