<table class="table table-hover table-bordered table-sm">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Orden ID</th>
			<th scope="col">Producto</th>
			<th scope="col">Cantidad</th>
			<th scope="col">Precio Unitario</th>
			<th scope="col">Precio Total</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>					
		@if (!empty($result_cliente_orden) && !$result_cliente_orden->isEmpty())
			@foreach ($result_cliente_orden as $cliente_orden)
				<tr>
					<td>
					{{ !empty($cliente_orden->id_orden) ? $cliente_orden->id_orden : '' }}
					</td>
					<td>
						{{ !empty($cliente_orden->nombre_producto) ? $cliente_orden->nombre_producto : '' }}
					</td>					
					<td>
						{{ !empty($cliente_orden->cantidad_piezas) ? $cliente_orden->cantidad_piezas : '' }}
					</td>
					<td>
						{{ !empty($cliente_orden->precio_unitario) ? $cliente_orden->precio_unitario : '' }}
					</td>
					<td>
						{{ !empty($cliente_orden->nombre_producto) ? ($cliente_orden->precio_unitario * $cliente_orden->cantidad_piezas) : '0' }}
					</td>
					<td>
						<button type="button" class="btn btn-primary" id="openModalCliente_Orden_AddEdit" data-id-orden="{{ (!empty($cliente_orden->id_orden) && !empty($cliente_orden->id_orden)) ? $cliente_orden->id_orden : '' }}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square-o"></i></button>
					</td>
				</tr>
				
			@endforeach
		@endif
			
	</tbody>
</table>

@if (!empty($result_cliente_orden) && !$result_cliente_orden->isEmpty() && !empty($result_cliente_orden->links()))
	{{ $result_cliente_orden->links() }}
@endif