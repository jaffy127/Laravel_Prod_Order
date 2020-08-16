<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Imports\ProductoImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class ProductoController extends Controller
{
    public function index()
    {
    	$objProducto = new Producto();
    	$result_producto = $objProducto->getInfoProducto();
    	return view('sistema.producto.producto', compact('result_producto'));
    }

    public function postPutProducto($datos_post)
    {
    	$error = array();
    	$result_post = array();
    	$objProducto = new Producto();
    	$result_producto = $objProducto->getProductoById($datos_post);

    	if(!empty($datos_post->nombre_producto) && !empty($datos_post->codigo_producto)){

    		//editar
    		if(!empty($result_producto) && !empty($result_producto["id_producto"])){
    			$result_add_edit_producto = $objProducto->putProducto($datos_post);
    			if(isset($result_add_edit_producto) && $result_add_edit_producto == 1){
    				$result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
    			}
    			else{
    				$result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion, edicion"];
    			}
    		}
    		else{
    			//nuevo
    			$result_add_edit_producto = $objProducto->postProducto($datos_post);
    			if(!empty($result_add_edit_producto) && !empty($result_add_edit_producto->id_producto)){
    				$result_post = ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente"];
    			}
    			else{
    				$result_post = ["status"=>"error", "mensaje"=>"no se realizo la accion, guardar nuevo"];
    			}
    		}

    		return $result_post;
    	}

    	return ["status"=>"error", "mensaje"=>"no se realizo la accion"];

    }

    public function ajaxProducto(Request $request)
    {
    	$data_post = array();
    	if(!empty($request->datos)){
    		$data_post = json_decode(json_encode($request->datos));
    	}

    	if(!empty($request) && !empty($request->accion)){

    		switch ($request->accion) {
    			case 'openModalProducto_AddEdit': //abre el modal
    				$result_producto_by_id = array();    				
    				if(!empty($data_post) && !empty($data_post->id_producto)){
    					$objProducto = new Producto();
    					$result_producto_by_id = $objProducto->getProductoById($data_post);
    					//dd($result_producto_by_id);
    				}
    				return view('sistema.producto.modal.agregar_producto', compact('result_producto_by_id'));

    				break;
    			case 'postPutProducto':
    				return $this->postPutProducto($data_post);
    				break;

				case 'getTableProducto':
					$objProducto = new Producto();
			    	$result_producto = $objProducto->getInfoProducto();
			    	return view('sistema.producto.tabla_producto', compact('result_producto'));
					break;

                case 'searchTablaProducto':
                    $objProducto = new Producto();
                    $result_producto = $objProducto->getInfoProducto($data_post);
                    return view('sistema.producto.tabla_producto', compact('result_producto'));
                    break;

                case 'openModalProducto_ImportExcel':
                    
                    return view('sistema.producto.modal.import_producto');

                    break;

                case 'importProducto_toExcel':
                    return $this->import_Excel_Productos($request);
                    break;

                case 'openModalProducto_Similares':
                    $result_producto_similar = $data_post->result_producto_similar;
                    return view('sistema.producto.modal.producto_similares', compact('result_producto_similar'));
                    break;
    			default:
    				# code...
    				break;
    		}

    	}
    }

    public function import_Excel_Productos(Request $request)
    {
       $objProducto = new Producto();
       $result_producto_sin_id = array();
       $result_producto_id = array();
       $result_producto_similar = array();
       $result_producto_igual = array();
       $;

        if($request->hasFile('file')){

            $objProductoAll = $objProducto->getInfoProducto();
            $fileProducto = (new ProductoImport)->toArray($request->file('file'));

            if(count($fileProducto) > 0){

                foreach ($fileProducto as $key => $producto) {
                    foreach ($producto as $key1 => $value) {

                        //con id y con nombre
                        if(!is_null($value["nombre"]) && !empty($value["nombre"]) && !is_null($value["id_producto"])){                           
                           /* $objProducto->nombre_producto = !empty($value["nombre"]) ? $value["nombre"] : '';
                            $objProducto->codigo_producto = !empty($value["codigo"]) ? $value["codigo"] : '';
                            $objProducto->precio_producto = !empty($value["precio"]) ? $value["precio"] : '0';*/

                            //$this->postPutProducto($objProducto);
                            $result_producto_id[] = [$key1 => $value];
                        }
                        //sin id pero con nombre
                        elseif (!is_null($value["nombre"]) && !empty($value["nombre"]) && (is_null($value["id_producto"]) || empty($value["id_producto"]))) {

                            $result_producto_sin_id[] = [$key1 => $value];
                        }

                    }
                }

                
                //compara con los valores existente en la bd
                foreach ($objProductoAll as $producto) {
                    
                    foreach ($result_producto_sin_id as $key => $value) {
                        
                        foreach ($value as $key1 => $value1) {

                            //obtiene el valor de similitud
                            $similar = levenshtein(strtolower($producto->nombre_producto), strtolower($value1["nombre"]));

                            //similares, que se envian a la vista
                            if($similar > 0 && $similar <= 2){
                                $result_producto_similar[] = array("id_producto" => $producto->id_producto, "nombre_producto" => $producto->nombre_producto, "nombre" => $value1["nombre"], "precio" => $value1["precio"]/*, "check" => false*/);
                            }
                            elseif ($similar == 0) { //iguales, directo a guardar
                                $result_producto_igual[] = array("id_producto" => $producto->id_producto, "precio" => $value1["precio"]);
                            }

                        }
                    }
                }

                //guardar los que tienen Id
                if(count($result_producto_id) > 0){

                }

                //actualiza los SIN id pero el nombre existe y es igual
                if(count($result_producto_igual) > 0){

                }

                if(count($result_producto_similar) > 0){
                    //return view('sistema.producto.producto_similares', compact('result_producto_similar'));
                }
            
            }

        
        //dump($result_producto_similar);
        return ["status"=>"correcto", "mensaje"=>"Datos Guardados Correctamente", "result_producto_similar" => $result_producto_similar];
        
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_producto' => 'required|unique:posts|max:255',
            'codigo_producto' => 'required',
        ]);

    }
    
}
