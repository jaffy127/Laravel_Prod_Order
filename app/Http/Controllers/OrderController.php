<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use App\Cliente;
use App\Producto;

class OrderController extends Controller
{
    public function index()
    {
    	$objOrden = new Orden();
    	$result_orden = $objOrden->getInfoOrden();
    	return view('sistema.orden.orden', compact('result_orden'));
    }

    public function postPutOrden($datos_post)
    {
        $error = array();
        $result_post = array();
        $objOrden = new Orden();
        $result_orden = $objOrden->getOrdenById($datos_post);

        if(!empty($datos_post->id_cliente) && !empty($datos_post->id_producto)){
            //editar
            if(!empty($result_orden) && !empty($result_orden["id_orden"])){

                $resul_add_edit_orden = $objOrden->putOrden($datos_post);

                if(isset($resul_add_edit_orden) && $resul_add_edit_orden == 1){
                    $result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente", "data_flag_modal"=>$datos_post->data_flag_modal];
                }
                else{
                    $result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion", "data_flag_modal"=>$datos_post->data_flag_modal];
                }
            }
            //agregar
            else{

                $resul_add_edit_orden = $objOrden->postOrden($datos_post);

                if(!empty($resul_add_edit_orden) && !empty($resul_add_edit_orden->id_orden)){
                    $result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente", "data_flag_modal"=>$datos_post->data_flag_modal];
                }
                else{
                    $result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion", "data_flag_modal"=>$datos_post->data_flag_modal];
                }
            }

            return $result_post;
        }
        return ["status"=>"error", "mensaje"=>"no se realizo la accion", "data_flag_modal"=>$datos_post->data_flag_modal];
    }

    public function ajaxOrden(Request $request)
    {
    	$data_post = array();
    	if(!empty($request->datos)){
    		$data_post = json_decode(json_encode($request->datos));
    	}

    	if(!empty($request) && !empty($request->accion)){

    		switch ($request->accion) {
    			case 'openModalOrden_AddEdit':
    				$result_orden_by_id = array();
    				if(!empty($data_post) && !empty($data_post->id_orden)){
    					$objOrden = new Orden();
    					$result_orden_by_id = $objOrden->getOrdenById($data_post);
    				}

    				$objCliente = new Cliente();
    				$result_cliente = $objCliente->getInfoCliente($data_post);    				

    				$objProducto = new Producto();
    				$result_producto = $objProducto->getInfoProducto($data_post);
    				
    				return view('sistema.orden.modal.agregar_orden', compact('result_orden_by_id', 'result_cliente', 'result_producto'));
    				break;

    			case 'postPutOrden':
    				return $this->postPutOrden($data_post);
    				break;

    			case 'getTableOrden':
    				$objOrden = new Orden();
			    	$result_orden = $objOrden->getInfoOrden($data_post);
			    	return view('sistema.orden.tabla_orden', compact('result_orden'));
    				break;
    			
    			case 'searchTablaOrden':
    				$objOrden = new Orden();
			    	$result_orden = $objOrden->getInfoOrden($data_post);
			    	return view('sistema.orden.tabla_orden', compact('result_orden'));
    				break;
    			default:
    				# code...
    				break;
    		}

    	}
    }
}
