{{-- modalImport_Producto_similares --}}
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	    <h5 class="modal-title" id="">Productos importados similares, Actualizar precion.</h5>
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
	
		<div class="py-md-3" id="tabla_orden">
			@include('sistema.producto.modal.tabla_import_similares_producto')
		</div>		

	  </div>
	  <div class="modal-footer" id="ProductosSimilares_footer">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>	    
	  </div>
	</div>
</div>
