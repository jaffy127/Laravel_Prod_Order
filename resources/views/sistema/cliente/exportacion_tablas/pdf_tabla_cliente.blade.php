<!DOCTYPE html>
<html>
	<head>
		<style>
			@page {
    			margin: 100px 25px;
			}

			header {
			    position: fixed;
			    top: -60px;
			    left: 0px;
			    right: 0px;
			    height: 50px;

			    background-color: #03a9f4;
			    color: white;
			    text-align: center;
			    line-height: 35px;
			}

			footer {
			    position: fixed; 
			    bottom: -60px; 
			    left: 0px; 
			    right: 0px;
			    height: 50px; 

			    background-color: #03a9f4;
			    color: white;
			    text-align: center;
			    line-height: 35px;
			}

			/*Salto de linea*/
			.page-break {
			    page-break-after: always;
			}

			.page-number:before {
			  	content: "Página " counter(page);
			}
		</style>
		{{-- <link rel="stylesheet" href="{{ asset('css/pdf_styles/pdf_style_cliente.css') }}">  --}}
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	</head>
	<main>		
		<header>
			<h3>Listado de CLientes</h3>
		</header>

		<table class="table table-hover table-bordered datatable" id="dtBasicExample">
			<thead class="thead-dark">
				<tr>
					<th >Nombre</th>
					<th >Dirección</th>	
					<th >Email</th>
					<th >Moneda</th>
				</tr>
			</thead>
			<tbody>
				
					@if (!empty($result_cliente) && !$result_cliente->isEmpty())				
						@foreach ($result_cliente as $cliente)
							
							<tr>
								<th scope="row">							
									<p>{{ !empty($cliente->nombre_cliente) ? $cliente->nombre_cliente : ''}}</p>
								</th>

								<td>
									{{ !empty($cliente->direccion) ? $cliente->direccion : ''}}
								</td>

								<td>
									{{ !empty($cliente->email) ? $cliente->email : ''}}
								</td>

								<td>
									{{ !empty($cliente->moneda) ? $cliente->moneda : ''}}
								</td>
							</tr>

						@endforeach
					@endif
				
			</tbody>
		</table>

		<footer>
			<div class="page-number"></div>
			{{-- <div class="page-break"></div> --}}
			
		</footer>
		
		<script type="text/php">
		    if (isset($pdf)) {
		        $text = "page {PAGE_NUM} / {PAGE_COUNT}";
		        $size = 10;
		        $font = $fontMetrics->getFont("Verdana");
		        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
		        $x = ($pdf->get_width() - $width) / 2;
		        $y = $pdf->get_height() - 35;
		        $pdf->page_text($x, $y, $text, $font, $size);
		    }
		</script>

	</main>


	
</html>