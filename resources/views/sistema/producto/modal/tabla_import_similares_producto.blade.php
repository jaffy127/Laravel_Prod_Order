<table class="table table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Nombre Ingresado</th>
			<th scope="col">Nombre Similar</th>	
			<th scope="col">Precio</th>			
			<th scope="col">Acción</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			@if (!empty($result_producto_similar))				
				@foreach ($result_producto_similar as $producto)
					
					<tr>
						<th scope="row">							
							Usted escribio: <b>{{ $producto->nombre }}</b>
						</th>
						
						<th scope="row">							
							¿Usted quiso decir: <b>{{ $producto->nombre_producto }}?</b>
						</th>

						<th scope="row">							
							{{ $producto->precio }}
						</th>
						
						<th scope="row">							
							<input type="checkbox" name="actualizar_precio" value="0">Actualizar</br>
						</th>
						
					</tr>

				@endforeach
			@endif
		</tr>
	</tbody>
</table>

<!-- paginación -->
{{-- @if (!empty($result_producto) && !$result_producto->isEmpty() && !empty($result_producto->links()))
	{{ $result_producto->links() }}
@endif --}}