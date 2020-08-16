<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	  	@if (!empty($result_producto_by_id) && !empty($result_producto_by_id->id_producto))
	  	    <h5 class="modal-title" id="">Editar Producto</h5>
	  	@else
	  		<h5 class="modal-title" id="">Agregar Producto</h5>
	  	@endif
	    
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
	    <form id="addEditFormProducto" method="post">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="nombre_producto">Nombre</label>
					<input type="text" autocomplete="off" class="form-control" name="nombre_producto" id="nombre_producto" value="{{ (!empty($result_producto_by_id) && !empty($result_producto_by_id->nombre_producto)) ? $result_producto_by_id->nombre_producto : ''   }}" >
				</div>
				<div class="form-group col-md-6">
					<label for="codigo_producto">Código del producto</label>
					<input type="codigo_producto" autocomplete="off" class="form-control" name="codigo_producto" id="codigo_producto" value="{{ (!empty($result_producto_by_id) && !empty($result_producto_by_id->codigo_producto)) ? $result_producto_by_id->codigo_producto : ''  }}" onkeyup="mayus(this);">
				</div>
				<div class="form-group col-md-4">
					<label for="precio_producto">Precio unitario</label>
					<input type="number" autocomplete="off" class="form-control" id="precio_producto" name="precio_producto" value="{{ (!empty($result_orden_by_id) && !empty($result_orden_by_id->precio_producto) ? $result_orden_by_id->precio_producto : '0' ) }}">
				</div>
			</div>
		</form>
	  </div>
	  <div class="modal-footer" id="addEditFormProducto_footer">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

		@if (!@empty ($result_producto_by_id) && !empty($result_producto_by_id->id_producto))
			<input type="hidden" name="id_producto" id="id_producto" value="{{ $result_producto_by_id->id_producto }}">
			<button type="button" class="btn btn-primary" id="putEditProducto">Guardar Cambios</button>
		@else
			<button type="button" class="btn btn-primary" id="postAddProducto">Guardar</button>
		@endif

	    
	  </div>
	</div>
</div>