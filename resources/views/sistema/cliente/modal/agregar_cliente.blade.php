<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	  	@if (!empty ($result_cliente_by_id) && !empty($result_cliente_by_id->id_cliente))
	  	    <h5 class="modal-title" id="">Editar Cliente</h5>
	  	@else
	  		<h5 class="modal-title" id="">Agregar Cliente</h5>
	  	@endif
	    
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
	    <form id="addEditFormCliente" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nombre_cliente">Nombre</label>
					<input type="text" autocomplete="off" class="form-control" name="nombre_cliente" id="nombre_cliente" value="{{ (!empty($result_cliente_by_id) && !empty($result_cliente_by_id->nombre_cliente) ? $result_cliente_by_id->nombre_cliente : '' )  }}">
				</div>
				<div class="form-group col-md-6">
					<label for="email">Email</label>
					<input type="email" autocomplete="off" class="form-control" name="email" id="email" value="{{ (!empty($result_cliente_by_id) && !empty($result_cliente_by_id->email) ? $result_cliente_by_id->email : '' ) }}">
				</div>
			</div>
			<div class="form-group">
				<label for="direccion">Dirección</label>
				<textarea name="direccion" autocomplete="off" id="direccion" class="form-control" placeholder="">{{ (!empty($result_cliente_by_id) && !empty($result_cliente_by_id->direccion) ? $result_cliente_by_id->direccion : '' ) }}</textarea>
			</div>
			
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="telefono">Teléfono</label>
					<input type="phone" autocomplete="off" class="form-control" id="telefono" name="telefono" value="{{ (!empty($result_cliente_by_id) && !empty($result_cliente_by_id->telefono) ? $result_cliente_by_id->telefono : '' ) }}">
				</div>
				<div class="form-group col-md-6">
					<label for="moneda">Moneda</label>
					<select id="moneda" name="moneda" class="form-control">
						<option selected>Selecciona...</option>
						@if (!empty($result_cliente_by_id) && !empty($result_cliente_by_id->moneda))						
							<option value="USD" {!! ($result_cliente_by_id->moneda =='USD' ? "selected=\"selected\"" : "") !!}>USD</option>
						    <option value="MXN" {!! ($result_cliente_by_id->moneda == 'MXN' ? "selected=\"selected\"" : "") !!}>MXN</option>
						@else
							<option value="USD">USD</option>
							<option value="MXN">MXN</option>
						@endif
					
					</select>
				</div>				
			</div>				
		</form>
	  </div>
	  <div class="modal-footer" id="addEditFormCliente_footer">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

		@if (!@empty ($result_cliente_by_id) && !empty($result_cliente_by_id->id_cliente))
			<input type="hidden" name="id_cliente" id="id_cliente" value="{{ $result_cliente_by_id->id_cliente }}">
			<button type="button" class="btn btn-primary" id="putEditCliente">Guardar Cambios</button>
		@else
			<button type="button" class="btn btn-primary" id="postAddCliente">Guardar</button>
		@endif

	    
	  </div>
	</div>
</div>