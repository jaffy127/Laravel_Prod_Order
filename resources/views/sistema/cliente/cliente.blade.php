@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-md-12">
		<a class="btn btn-primary " href="" title="" id="openModalCliente_AddEdit" data-accion="openModalCliente_AddEdit">Cliente Nuevo</a>
		
		<a class="btn btn-info" href="" id="openModalCliente_ImportExcel" name="openModalCliente_ImportExcel"><i class="fas fa-file-import"></i> Importar Excel</a>

		<a class="btn btn-success" href="{{ route('path_export_excel_cliente') }}" title="" id="exportClientes_toExcel"><i class="fas fa-file-export"></i> Exportar Excel</a>

		<a class="btn btn-danger" href="{{ route('path_export_pdf_cliente') }}" title="" id="exportClientes_toPDF"><i class="fas fa-file-export"></i> Exportar PDF </a>

		<form class="form-inline float-right" id="searh_cliente">
			<div class="form-group mb-2">
				
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<label for="searh_nombre_cliente" class="sr-only">Buscar Cliente</label>
				<input type="text" autocomplete="off" class="form-control" id="searh_nombre_cliente" name="searh_nombre_cliente" placeholder="Buscar">
			</div>
			<button type="submit" class="btn btn-primary mb-2" id="search_tabla_cliente">Buscar Cliente</button>
		</form>
	</div>
</div>


<div class="container py-md-3">
	<div class="row" id="tabla_cliente">
		@include('sistema.cliente.tabla_cliente')
	</div>
	
</div>

<div id="modalCliente" class="modalCliente modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL agregar_cliente --}}
</div>

<div id="modalCliente_orden" class="modalCliente_orden modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL ver_orden_cliente --}}
</div>

<div id="modalOrden" class="modalOrden modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL agregar_order --}}
</div>

<div id="modalImport_Cliente" class="modalImport_Cliente modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL importar cliente --}}
</div>

@stop

@section('js')
	@include('sistema.cliente.includes.script_js_cliente')
	@include('sistema.orden.includes.script_js_order')
	@include('sistema.includes.script_js_sistema')
@stop