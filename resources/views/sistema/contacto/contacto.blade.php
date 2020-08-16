@extends('layouts.default')

@section('content')

<div class="container">
	<div class="card">
		<div class="card-header"><h4 class="card-title">Forumulario de contacto</h4></div>
		<div class="card-body">
			<form id="formContacto">
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="contacto_email">Email</label>
						<input type="email" autocomplete="off" class="form-control" id="contacto_email">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="contacto_asunto">Asunto</label>
						<input type="text" autocomplete="off" class="form-control" id="contacto_asunto">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="contacto_mensaje">Mensaje</label>
						<textarea ype="text" class="form-control" id="contacto_mensaje" name="contacto_mensaje" placeholder="Escribe aquí..."></textarea>
					</div>					
				</div>
				<button type="submit" class="btn btn-primary" id="contacto_enviar">Enviar</button>
			</form>
		</div>
	</div>
</div>

@stop

@section('js')
	@include('sistema.contacto.includes.script_js_contacto')
@stop