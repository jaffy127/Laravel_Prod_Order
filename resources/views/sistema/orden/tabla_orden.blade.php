<table class="table table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Order Id</th>
			<th scope="col">Cliente</th>	
			<th scope="col">Producto</th>
			<th scope="col">Fecha de pedido</th>
			<th scope="col">Fecha de entrega</th>
			<th scope="col">Acciones</th>

		</tr>
	</thead>
	<tbody>
		<tr>
			@if (!empty($result_orden) && !$result_orden->isEmpty())
				@foreach ($result_orden as $orden)
					
					<tr>
						<th scope="row">
							{{ !empty($orden->id_orden) ? $orden->id_orden : ''}}
						</th>

						<td>
							{{ !empty($orden->nombre_cliente) ? $orden->nombre_cliente : ''}}
						</td>

						<td>
							{{ !empty($orden->nombre_producto) ? $orden->nombre_producto : ''}}
						</td>

						<td>
							{{ !empty($orden->created_at) ? ($orden->created_at)->format('Y-m-d') : ''}}
						</td>

						<td>
							{{ !empty($orden->fecha_entrega) ? ($orden->fecha_entrega) : ''}}
						</td>

						<td>
                        	<div class="btn-group" role="group" aria-label="Basic example">							 	
					            {{-- <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button> --}}
					            <button type="button" class="btn btn-primary" id="openModalOrden_AddEdit" data-id-orden="{{ (!empty($orden) && !empty($orden->id_orden)) ? $orden->id_orden : '' }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square-o"></i></button>
							</div>
                        	
						</td>

					</tr>

				@endforeach
			@endif
		</tr>
	</tbody>
</table>

<!-- paginación -->
@if (!empty($result_orden) && !$result_orden->isEmpty() && !empty($result_orden->links()))
	{{ $result_orden->links() }}
@endif