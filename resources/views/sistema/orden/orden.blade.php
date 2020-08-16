@extends('layouts.default')

@section('content')

<div class="row">
	<div class="col-md-12">
	<a class="btn btn-primary" href="" title="" id="openModalOrden_AddEdit" data-toggle="modal" data-target="modalOrden">Order Nuevo</a>

	<form class="form-inline float-right" id="search_orden">
		<div class="form-group mb-2">
			
		</div>
		<div class="form-group mx-sm-3 mb-2">
			<label for="searh_nombre_orden_cliente" class="sr-only">Buscar Order</label>
			<input type="text" autocomplete="off" class="form-control" id="searh_nombre_orden_cliente" name="searh_nombre_orden_cliente" placeholder="Buscar">
		</div>
		<button type="submit" class="btn btn-primary mb-2" id="search_tabla_orden">Buscar por cliente</button>
	</form>
</div>
</div>


<div class="container py-md-3">
	<div class="row" id="tabla_orden">
		@include('sistema.orden.tabla_orden')
	</div>
	
</div>

<div id="modalOrden" class="modalOrden modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	{{-- MODAL agregar_order --}}
</div>

@stop

@section('js')
	@include('sistema.orden.includes.script_js_order')
	@include('sistema.includes.script_js_sistema')
@stop