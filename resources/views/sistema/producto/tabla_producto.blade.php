<table class="table table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Código</th>
			<th scope="col">Nombre</th>	
			<th scope="col">Precio</th>			
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@if (!empty($result_producto) && !$result_producto->isEmpty())				
				@foreach ($result_producto as $producto)
					
					<tr>
						<th scope="row">							
							<p>{{ !empty($producto->codigo_producto) ? $producto->codigo_producto : ''}}</p>
						</th>

						<td>
							{{ !empty($producto->nombre_producto) ? $producto->nombre_producto : ''}}
						</td>

						<td>
							{{ !empty($producto->precio_producto) ? $producto->precio_producto : ''}}
						</td>						

						<td>
                        	<div class="btn-group" role="group" aria-label="Basic example">							 	
					            {{-- <button type="button" class="btn btn-success"><i class="fa fa-eye"></i></button> --}}
					            <button type="button" class="btn btn-primary" id="openModalProducto_AddEdit" data-id-producto="{{ (!empty($producto) && !empty($producto->id_producto)) ? $producto->id_producto : '' }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square-o"></i></button>
							</div>
						</td>

					</tr>

				@endforeach
			@endif
		</tr>
	</tbody>
</table>

<!-- paginación -->
@if (!empty($result_producto) && !$result_producto->isEmpty() && !empty($result_producto->links()))
	{{ $result_producto->links() }}
@endif