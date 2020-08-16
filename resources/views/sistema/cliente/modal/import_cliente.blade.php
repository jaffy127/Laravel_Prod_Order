<div class="modal-dialog " role="document">
	<div class="modal-content ">
	  <div class="modal-header">
	  	<h5 class="modal-title" id="">Importar Clientes</h5>
	    
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="modal-body">	    
				
		<form {{-- action="{{ route('path_import_excel_cliente') }}" --}} id="FormImportCliente" method="post" enctype="multipart/form-data" class="form-row align-items-center">			
			<div class="form-group">
				<input type="file" class="form-control-file" name="file" id="file" required >
			</div>
			<a class="btn btn-info" type="submit" href="" id="importClientes_toExcel"><i class="fas fa-file-import"></i> Importar Excel</a>
	
		</form>

	  </div>
	  <div class="modal-footer" id="">
	    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>	    
	  </div>
	</div>
</div>