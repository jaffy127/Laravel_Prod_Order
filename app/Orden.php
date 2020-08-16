<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = "ordenes";
    public $incrementing = true;
    public $timestamps = true;
    protected $primaryKey = "id_orden";
    protected $fillable = ["id_orden", 
    						"id_cliente",
    						"id_producto",
    						"cantidad_piezas",
    						"precio_unitario",
    						"tipo_empaque",
    						"fecha_produccion",
    						"fecha_entrega",
    						"created_at",
    						"updated_at"
    					];
    public $rows = 10;

    public function getInfoOrden($data_json=null)
    {
        if(is_null($data_json)){
            $data_json = new \stdClass();
        }

        if(!empty($data_json->seccion)){
            switch ($data_json->seccion) {
                case 'modal_orden':
                   $select_orden = ["id_orden", "ordenes.id_cliente", "ordenes.id_producto", "ordenes.created_at", "fecha_entrega"];
                    break;
                case 'modal_orden_cliente':
                    $select_orden = ["id_orden", "ordenes.id_cliente", "nombre_producto", "ordenes.id_producto", "ordenes.created_at", "ordenes.fecha_entrega", "ordenes.cantidad_piezas", "ordenes.precio_unitario", "ordenes.tipo_empaque"];
                    break;
                default:
                    $select_orden = ["id_orden", "nombre_cliente", "nombre_producto", "ordenes.created_at", "fecha_entrega"];
                    break;
            }
        }
        else{
           $select_orden = ["id_orden", "nombre_cliente", "ordenes.id_producto" ,"nombre_producto", "ordenes.created_at", "fecha_entrega"];
        }

        if(!isset($data_json) && !isset($data_json->rows)){
            $data_json->rows = $this->rows;
        }

        $objOrden = new Orden();

        if(!empty($data_json) && !empty($data_json->id_cliente)){

            $result_order = $objOrden::join('productos', 'productos.id_producto', '=', 'ordenes.id_producto')
                            ->select($select_orden)
                            ->where("id_cliente", "=", $data_json->id_cliente)
                            /*->where(function($query) use ($data_json){

                                if(!empty($data_json) && !empty($data_json->nombre_cliente) && empty($data_json->id_cliente)){
                                    $query->where("nombre_cliente", "LIKE", "%".$data_json->nombre_cliente."%");
                                }

                            })*/
                            ->orderBy('id_orden')
                            ->paginate($this->rows);
        }
        else{

            $result_order = $objOrden::join('clientes', 'clientes.id_cliente', '=', 'ordenes.id_cliente')
                            ->join('productos', 'productos.id_producto', '=', 'ordenes.id_producto')
                            ->select($select_orden)     
                            ->where(function($query) use ($data_json){

                                if(!empty($data_json) && !empty($data_json->nombre_cliente)){
                                    $query->where("nombre_cliente", "LIKE", "%".$data_json->nombre_cliente."%");
                                }

                            })                       
                            ->orderBy('id_orden')
                            ->paginate($this->rows);
        }        

        return $result_order;

    }

    public function getOrdenById($data_json)
    {
        //obtener orden por Id
        $objOrden = new Orden();

        if(!empty($data_json->id_orden)){
            $result_orden = $objOrden->where("id_orden", $data_json->id_orden )->first();

            return $result_orden;
        }
        else{
            return [];
        }
    }

    public function postOrden($data_json)
    {
       $objOrden = new Orden();
       $objOrden->id_cliente = (isset($data_json->id_cliente) && !empty($data_json->id_cliente)) ? $data_json->id_cliente : '';
       $objOrden->id_producto = (isset($data_json->id_producto) && !empty($data_json->id_producto)) ? $data_json->id_producto : '';
       $objOrden->cantidad_piezas = (isset($data_json->cantidad_piezas) && !empty($data_json->cantidad_piezas)) ? $data_json->cantidad_piezas : '';
       $objOrden->precio_unitario = (isset($data_json->precio_unitario) && !empty($data_json->precio_unitario)) ? $data_json->precio_unitario : '';
       $objOrden->tipo_empaque = (isset($data_json->tipo_empaque) && !empty($data_json->tipo_empaque)) ? $data_json->tipo_empaque : '';
       $objOrden->fecha_produccion = (isset($data_json->fecha_produccion) && !empty($data_json->fecha_produccion)) ? $data_json->fecha_produccion : '';
       $objOrden->fecha_entrega = (isset($data_json->fecha_entrega) && !empty($data_json->fecha_entrega)) ? $data_json->fecha_entrega : '';
       $objOrden->save();
       return $objOrden;
    }

    public function putOrden($data_json)
    {
        $objOrden = new Orden();
        $array_edit_orden = array();

        if(!empty($data_json->id_cliente)){
            $array_edit_orden["id_cliente"] = $data_json->id_cliente;
        }
        if(!empty($data_json->id_producto)){
            $array_edit_orden["id_producto"] = $data_json->id_producto;
        }
        if(!empty($data_json->cantidad_piezas)){
            $array_edit_orden["cantidad_piezas"] = $data_json->cantidad_piezas;
        }
        if(!empty($data_json->precio_unitario)){
            $array_edit_orden["precio_unitario"] = $data_json->precio_unitario;
        }
        if(!empty($data_json->tipo_empaque)){
            $array_edit_orden["tipo_empaque"] = $data_json->tipo_empaque;
        }
        if(!empty($data_json->fecha_produccion)){
            $array_edit_orden["fecha_produccion"] = $data_json->fecha_produccion;
        }
        if(!empty($data_json->fecha_entrega)){
            $array_edit_orden["fecha_entrega"] = $data_json->fecha_entrega;
        }

        $result_orden = $objOrden
                                ->where("id_orden", (!empty($data_json->id_orden) ? $data_json->id_orden : ''))
                                ->update($array_edit_orden);

        return $result_orden;
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
