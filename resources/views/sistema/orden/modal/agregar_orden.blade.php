<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	  	@if (!empty($result_orden_by_id) && !empty($result_orden_by_id->id_orden))
	  	    <h5 class="modal-title" id="">Editar Orden</h5>
	  	@else
	  		<h5 class="modal-title" id="">Agregar Orden</h5>
	  	@endif
	    
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
	    <form id="addEditFormOrden" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="id_cliente">Cliente</label>					
					<select id="id_cliente" name="id_cliente" class="form-control" {!! ((!empty($result_orden_by_id) && !empty($result_orden_by_id->id_cliente))) ? "disabled" : "" !!}>
						<option selected>Selecciona...</option>
						@if (!empty($result_orden_by_id) && !empty($result_orden_by_id->id_orden))
							@if (!empty($result_cliente) && !$result_cliente->isEmpty())						
								@foreach ($result_cliente as $cliente)
									<option value="{{ $cliente->id_cliente }}" 
										{!! ((($result_orden_by_id->id_cliente == $cliente->id_cliente)) ? "selected=\"selected\"" : "") !!}>
										{{ $cliente->nombre_cliente }}
									</option>
								@endforeach								
							@endif
						@else
							@if (!empty($result_cliente) && !$result_cliente->isEmpty()))						
								@foreach ($result_cliente as $cliente)
									<option value="{{ $cliente->id_cliente }}">
										{{ $cliente->nombre_cliente }}
									</option>
								@endforeach
								
							@endif

						@endif


					</select>
				</div>
				<div class="form-group col-md-6">
					<label for="id_producto">Producto</label>
					<select id="id_producto" name="id_producto" class="form-control" 
					{{-- {!! ((!empty($result_orden_by_id) && !empty($result_orden_by_id->id_producto)) ? "disabled" : "") !!} --}}>
						<option selected>Selecciona...</option>
						@if (!empty($result_orden_by_id) && !empty($result_orden_by_id->id_orden))
							@if (!empty($result_producto) && !$result_producto->isEmpty())						
								@foreach ($result_producto as $producto)
									<option value="{{ $producto->id_producto }}" 
										{!! (($result_orden_by_id->id_producto == $producto->id_producto) ? "selected=\"selected\"" : "") !!}>
										{{ $producto->nombre_producto }}
									</option>
								@endforeach								
							@endif
						@else
							@if (!empty($result_producto) && !$result_producto->isEmpty()))						
								@foreach ($result_producto as $producto)
									<option value="{{ $producto->id_producto }}">
										{{ $producto->nombre_producto }}
									</option>
								@endforeach
								
							@endif
						@endif					
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="direccion">Fecha de Creación</label>
					<input type="date" name="created_at" id="created_at" class="form-control date" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->created_at) ? ($result_orden_by_id->created_at)->format('Y-m-d') : today()->format('Y-m-d')) }}" disabled>
				</div>
				<div class="form-group col-md-4">
					<label for="fecha_produccion">Fecha de producción</label>
					<input type="date" name="fecha_produccion" id="fecha_produccion" class="form-control" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->fecha_produccion) ? $result_orden_by_id->fecha_produccion : '') }}">
				</div>

				<div class="form-group col-md-4">
					<label for="fecha_entrega">Fecha de Entrega</label>
					<input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->fecha_entrega) ? $result_orden_by_id->fecha_entrega : '') }}">
				</div>

			</div>
			
			<div class="form-row">
				<div class="form-group col-md-4">
					<label for="precio_unitario">Precio unitario</label>
					{{-- cargar el precio que tenga el producto cuando sea nuevo --}}
					<input type="number" autocomplete="off" class="form-control" id="precio_unitario" name="precio_unitario" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->precio_unitario) ? $result_orden_by_id->precio_unitario : '0' ) }}">
				</div>
				<div class="form-group col-md-4">
					<label for="cantidad_piezas">Cantidad</label>
					<input type="number" name="cantidad_piezas" id="cantidad_piezas" class="form-control" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->cantidad_piezas) ? $result_orden_by_id->cantidad_piezas : '0' ) }}">
				</div>	
				<div class="form-group col-md-4">
					<label for="tipo_empaque">Tipo de empaque</label>
					<select  id="tipo_empaque" name="tipo_empaque" class="form-control">
						<option >
							<option selected>Selecciona...</option>
							@if (!empty($result_orden_by_id) && !empty($result_orden_by_id->tipo_empaque))						
							<option value="BULK" {!! ($result_orden_by_id->tipo_empaque ==='BULK' ? "selected=\"selected\"" : "") !!}>BULK</option>
						    <option value="MULTIPACK" {!! ($result_orden_by_id->tipo_empaque === 'MULTIPACK' ? "selected=\"selected\"" : "") !!}>MULTIPACK</option>
						    <option value="NONE" {!! ($result_orden_by_id->tipo_empaque === 'NONE' ? "selected=\"selected\"" : "") !!}>NONE</option>
							@else
								<option value="BULK">BULK</option>
								<option value="MULTIPACK">MULTIPACK</option>
								<option value="NONE">NONE</option>
							@endif
						</option>

					</select>
				</div>			
			</div>				
		</form>
	  </div>
	  <div class="modal-footer" id="addEditFormOrden_footer">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		@if (!@empty ($result_orden_by_id) && !empty($result_orden_by_id->id_orden))
			<input type="hidden" name="id_orden" id="id_orden" value="{{ $result_orden_by_id->id_orden }}">
			<button type="button" class="btn btn-primary" id="putEditOrden" data-flag-modal="by_orden">Guardar Cambios</button>
		@else
			<button type="button" class="btn btn-primary" id="postAddOrden" data-flag-modal="by_orden">Guardar</button>
		@endif	    
	  </div>
	</div>
</div>