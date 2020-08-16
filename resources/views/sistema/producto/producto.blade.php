@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary" href="" title="" id="openModalProducto_AddEdit" data-toggle="modal" data-target="modalProducto">Producto Nuevo</a>

		<a class="btn btn-info" href="" id="openModalProducto_ImportExcel" name="openModalProducto_ImportExcel"><i class="fas fa-file-import"></i> Importar Excel</a>

		<a class="btn btn-success" href="" title="" id="exportClientes_toExcel"><i class="fas fa-file-export"></i> Exportar Excel</a>

		<a class="btn btn-danger" href="" title="" id="exportClientes_toPDF"><i class="fas fa-file-export"></i> Exportar PDF </a>

		<form class="form-inline float-right" id="searh_producto">
			<div class="form-group mb-2">
				
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<label for="searh_nombre_producto" class="sr-only">Buscar Producto</label>
				<input type="text" autocomplete="off" class="form-control" id="searh_nombre_producto" name="searh_nombre_producto" placeholder="Buscar">
			</div>
			<button type="submit" class="btn btn-primary mb-2" id="search_tabla_cliente">Buscar Producto</button>
		</form>
	</div>
</div>


<div class="container py-md-3">
	<div class="row" id="tabla_producto">
		@include('sistema.producto.tabla_producto')
	</div>
	
</div>

<div id="modalProducto" class="modalProducto modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL agregar_producto --}}
</div>

<div id="modalImport_Producto" class="modalImport_Producto modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL Importar producto --}}
</div>

<div id="modalImport_Producto_similares" class="modalImport_Producto_similares modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL actualizar productos similares --}}
</div>

@stop

@section('js')
	@include('sistema.producto.includes.script_js_producto')
	@include('sistema.includes.script_js_sistema')
@stop