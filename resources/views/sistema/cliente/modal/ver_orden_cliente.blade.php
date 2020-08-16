<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	  	@if (!empty($result_cliente))
	  	    <h5 class="modal-title" id="">Ordenes del Cliente: {{ ($result_cliente->nombre_cliente) }}</h5>	  	    
	  	@else
	  		<h5 class="modal-title" id="">Ordenes del Cliente</h5>
	  	@endif
	    
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
		
	    <button type="button" class="btn btn-primary" id="openModalCliente_Orden_AddEdit" data-id-cliente="{{ $result_cliente->id_cliente }}" data-toggle="tooltip" data-placement="top" title="Nuevo Orden">Nueva Orden</button>

	   {{--  <p class="modal-title">Moneda: {{ $result_cliente->moneda }}</p> --}}
	
		<div class="py-md-3" id="tabla_orden">
			@include('sistema.cliente.modal.tabla_ver_orden_cliente')
		</div>		

	  </div>
	  <div class="modal-footer" id="addEditFormCliente_footer">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>	    
	  </div>
	</div>
</div>