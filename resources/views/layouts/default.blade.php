<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Orden de producción</title>
	
	{{-- <script src="https://use.fontawesome.com/ca93c55311.js"></script> --}}
	{{-- <script src="https://kit.fontawesome.com/79babf2861.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">  
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}"> 
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/> --}}
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
	
	<header id="header" class="">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="{{ route('path_cliente_index') }}">Inicio</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item ">
		        <a class="nav-link {{ (request()->routeIs('path_cliente_index')) ? 'active' : '' }}" href="{{ route('path_cliente_index') }}">Clientes <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item {{ (request()->routeIs('path_producto_index')) ? 'active' : '' }}">
		        <a class="nav-link" href="{{ route('path_producto_index') }}">Productos</a>
		      </li>
		      <li class="nav-item {{ (request()->routeIs('path_orden_index')) ? 'active' : '' }}">
		        <a class="nav-link" href="{{ route('path_orden_index') }}">Ordenes de Producción</a>
		      </li>
		      <li class="nav-item {{ (request()->routeIs('path_contacto')) ? 'active' : '' }}">
		        <a class="nav-link" href="{{ route('path_contacto') }}">Contacto</a>
		      </li>
		    </ul>
		  </div>
		</nav>
	</header>

	<div class="container py-md-3">
		@yield('content')		
	</div>


	<footer>
		
	</footer>

	<script src="{{asset('js/font-awesome.js')}}"></script>	
	<script src="{{asset('js/jquery-3.5.1.js')}}"></script>
	
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
	<script src="{{asset('js/datatables.min.js')}}"></script>	 
	
	@yield('js')
	<script>
		function ajaxSetup()
	    {
	        $.ajaxSetup({
	            headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
	    }
	</script>
</body>
</html>