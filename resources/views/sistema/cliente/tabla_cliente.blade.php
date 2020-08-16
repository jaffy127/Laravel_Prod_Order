<table class="table table-hover table-bordered datatable" id="dtBasicExample">
	<thead class="thead-dark">
		<tr>
			<th scope="col" aria-sort="ascending" aria-controls="dtBasicExample" class="sorting" rowspan="1">Nombre</th>
			<th scope="col" aria-sort="ascending" aria-controls="dtBasicExample" class="sorting" rowspan="1">Dirección</th>	
			<th scope="col" aria-sort="ascending" aria-controls="dtBasicExample" class="sorting" rowspan="1">Email</th>
			<th scope="col" aria-sort="ascending" aria-controls="dtBasicExample" class="sorting" rowspan="1">Moneda</th>
			<th scope="col" >Acciones</th>
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

						<td>

                        	<div class="btn-group" role="group" aria-label="Basic example">							 	
					            <button type="button" class="btn btn-success" id="openModalCliente_ViewOrden"  data-toggle="tooltip" data-placement="top" title="Ver ordenes" data-id-cliente="{{ (!empty($cliente) && !empty($cliente->id_cliente)) ? $cliente->id_cliente : '' }}"><i class="far fa-eye" ></i></button>

					            <button type="button" class="btn btn-primary" id="openModalCliente_AddEdit"  data-id-cliente="{{ (!empty($cliente) && !empty($cliente->id_cliente)) ? $cliente->id_cliente : '' }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square-o"></i></button>
							</div>

						</td>

					</tr>

				@endforeach
			@endif
		
	</tbody>
</table>

<!-- paginación -->
@if (!empty($result_cliente) && !$result_cliente->isEmpty() && !empty($result_cliente->links()))
	{{ $result_cliente->links() }}
@endif