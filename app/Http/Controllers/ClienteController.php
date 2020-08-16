<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Orden;
use App\Producto;

use App\Exports\ClientesExport;
use App\Imports\ClientesImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ClienteController extends Controller
{
    /*retorna los clientes*/
    public function index()
    {
    	$objCliente = new Cliente();
    	$result_cliente = $objCliente->getInfoCliente();
    	return view('sistema.cliente.cliente', compact('result_cliente'));
    }

    public function postPutCliente($datos_post)
    {
    	$error = array();
    	$result_post = array();
    	$objCliente = new Cliente();
    	$result_cliente = $objCliente->getClienteById($datos_post);

    	if(!empty($datos_post->nombre_cliente)){
    		//editar
    		if(!empty($result_cliente) && !empty($result_cliente["id_cliente"])){

    			$result_add_edit_cliente = $objCliente->putCliente($datos_post);

    			if(isset($result_add_edit_cliente) && $result_add_edit_cliente == 1){
    				$result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
    			}
    			else{
    				$result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion"];
    			}
    		}
    		//agregar
    		else{

    			$result_add_edit_cliente = $objCliente->postCliente($datos_post);

    			if(!empty($result_add_edit_cliente) && !empty($result_add_edit_cliente->id_cliente)){
    				$result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
    			}
    			else{
    				$result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion"];
    			}
    		}

    		return $result_post;
    	}
    	return ["status"=>"error", "mensaje"=>"no se realizo la accion"];
    }

    public function ajaxCliente(Request $request)
    {
    	$data_post = array();
    	if(!empty($request->datos)){
    		$data_post = json_decode(json_encode($request->datos));
    	}

    	if(!empty($request) && !empty($request->accion)){

    		switch ($request->accion) {
    			case 'openModalCliente_AddEdit':
    				$result_cliente_by_id = array();
    				if(!empty($data_post) && !empty($data_post->id_cliente)){
    					$objCliente = new Cliente();
    					$result_cliente_by_id = $objCliente->getClienteById($data_post);
    				}
    				return view('sistema.cliente.modal.agregar_cliente', compact('result_cliente_by_id'));
    				break;

    			case 'postPutCliente':
    				return $this->postPutCliente($data_post);
    				break;

    			case 'getTableCliente':
    				$objCliente = new Cliente();
			    	$result_cliente = $objCliente->getInfoCliente($data_post);
			    	return view('sistema.cliente.tabla_cliente', compact('result_cliente'));
    				break;
    			
    			case 'searchTablaCliente':
    				$objCliente = new Cliente();
			    	$result_cliente = $objCliente->getInfoCliente($data_post);
			    	return view('sistema.cliente.tabla_cliente', compact('result_cliente'));
    				break;

                case 'openModalCliente_ViewOrden':
                    $objOrden = new Orden();
                    $result_cliente_orden = $objOrden->getInfoOrden($data_post);
                    $objCliente = new Cliente();
                    $result_cliente = $objCliente->getNombreClienteById($data_post);
                    return view('sistema.cliente.modal.ver_orden_cliente', compact('result_cliente_orden', 'result_cliente'));
                    break;

                case 'getTableClientes_Orden':
                    $objOrden = new Orden();
                    $result_cliente_orden = $objOrden->getInfoOrden($data_post);
                    return view('sistema.cliente.modal.tabla_ver_orden_cliente', compact('result_cliente_orden'));

                    break;

                case 'openModalCliente_Orden_AddEdit':
                    $result_orden_by_id = array();
                    if(!empty($data_post) && !empty($data_post->id_orden)){
                        $objOrden = new Orden();
                        $result_orden_by_id = $objOrden->getOrdenById($data_post);
                    }

                    $result_cliente_id = (!empty($data_post) && !empty($data_post->id_cliente)) ? $data_post->id_cliente : '';

                    $objCliente = new Cliente();
                    $result_cliente = $objCliente->getInfoCliente();                    

                    $objProducto = new Producto();
                    $result_producto = $objProducto->getInfoProducto();
                    
                    return view('sistema.cliente.modal.agregar_orden_cliente', compact('result_orden_by_id', 'result_cliente', 'result_producto', 'result_cliente_id'));
                    break;

                case 'openModalCliente_ImportExcel':

                    return view('sistema.cliente.modal.import_cliente');
                    
                    break;

                case 'importClientes_toExcel':
                    return $this->import_Excel_Cliente($request);
                    break;

    			default:
    				# code...
    				break;
    		}

    	}
    }

    public function export_Excel_Cliente() 
    {
        //return Excel::download(new ClientesExport, 'clientes.xlsx');
        //return (new ClientesExport)->download('clientes.xlsx');
        //return (new ClientesExport)->download('clientes.xlsx', Excel::XLSX, ['Content-Type' => 'text/csv']);
        return new ClientesExport();
    }

    public function import_Excel_Cliente(Request $request)
    {
        $objCliente = new Cliente();
        $result_cliente = array();
        if($request->hasFile('file')){
            //crea una variable con los datos del archivo
            $fileClientes = (new ClientesImport)->toArray($request->file('file'));

            if(count($fileClientes) > 0){
                foreach ($fileClientes as $key => $cliente) {
                    foreach ($cliente as $key1 => $value) {
                        if(!is_null($value["nombre"])){
                            $objCliente->nombre_cliente = !empty($value["nombre"]) ? $value["nombre"] : '';
                            $objCliente->direccion = !empty($value["direccion"]) ?$value["direccion"] : '';
                            $objCliente->email = !empty($value["email"]) ? $value["email"] : '';
                            $objCliente->telefono = !empty($value["telefono"]) ? $value["telefono"] : '';
                            $objCliente->moneda = !empty($value["moneda"]) ? $value["moneda"] : '';

                            //$result_cliente[] = [$key1 => $value];
                            $this->postPutCliente($objCliente);
                            
                        }
                    }
                }
            }

            //dump($result_cliente);
            return ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
        }
    }

    public function export_PDF()
    {
        $objCliente = new Cliente();
        $result_cliente = $objCliente->getInfoCliente();
        $pdf = PDF::loadView('sistema.cliente.exportacion_tablas.pdf_tabla_cliente', compact('result_cliente'));
        return $pdf->stream('clientes.pdf');
    }
}
