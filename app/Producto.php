<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    public $incrementing = true;
    public $timestamps = true;
    protected $primaryKey = "id_producto";
    protected $fillable = ["id_producto", 
    						"nombre_producto",
    						"codigo_producto",
                            "precio_producto",
                            "created_at",
                            "updated_at"
    					];

    public function getInfoProducto($data_json=null)
    {
        //obtener los productos
    	if(is_null($data_json)){
            $data_json = new \stdClass();
        }

        if(!empty($data_json->seccion)){
            switch ($data_json->seccion) {
                case 'tabla_producto':
                    $select_producto = ["nombre_producto", "codigo_producto" ];
                    break;
                case 'modal_orden':
                    $select_producto = ["id_producto", "nombre_producto", "precio_producto" ];
                    break;
                default:
                    $select_producto = ["*"];
                    break;
            }
        }
        else{
             $select_producto = ["*"];
        }

        if(!isset($data_json) && !isset($data_json->rows)){
            $data_json->rows = $this->rows;
        }

        $objCliente = new Producto();
        $result_producto = $objCliente
                                    ->select($select_producto)
                                    ->where(function($query) use ($data_json){

                                        //realiza las consultas para las busquedas de cliente
                                        if(!empty($data_json) && !empty($data_json->nombre_producto) && empty($data_json->id_producto)){
                                            $query->where("nombre_producto", "LIKE", "%".$data_json->nombre_producto."%");
                                        }

                                    })
                                    ->orderBy("nombre_producto")
                                    ->paginate($this->rows);

        return $result_producto;
    }

    public function getProductoById($data_json)
    {
        //obtener los productos por ID
       $objProducto = new Producto();

        if(!empty($data_json->id_producto)){
            $result_producto = $objProducto->where("id_producto", $data_json->id_producto )->first();
            return $result_producto;
        }
        else{
            return [];
        }
    }

    public function postProducto($data_json)
    {
        //guardar nuevo producto
        $objProducto = new Producto();
        $objProducto->codigo_producto = (isset($data_json) && !empty($data_json->codigo_producto) ? $data_json->codigo_producto : '');
        $objProducto->nombre_producto = (isset($data_json) && !empty($data_json->nombre_producto) ? $data_json->nombre_producto : '');
        $objProducto->precio_producto = (isset($data_json) && !empty($data_json->precio_producto) ? $data_json->precio_producto : '');
        $objProducto->save();
        return $objProducto;
    }

    public function putProducto($data_json)
    {
        //editar producto
         $objProducto = new Producto();
         $arr_edit_producto = array();

         if(!empty($data_json->codigo_producto)){
            $arr_edit_producto["codigo_producto"] = $data_json->codigo_producto;
         }
         if(!empty($data_json->nombre_producto)){
            $arr_edit_producto["nombre_producto"] = $data_json->nombre_producto;
         }
         if(!empty($data_json->precio_producto)){
            $arr_edit_producto["precio_producto"] = $data_json->precio_producto;
         }

         $result_producto = $objProducto
                                    ->where("id_producto", (!empty($data_json->id_producto) ? $data_json->id_producto : ''))
                                    ->update($arr_edit_producto);
        return $result_producto;
    }
}
