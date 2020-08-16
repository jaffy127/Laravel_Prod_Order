<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = "id_cliente";
    protected $fillable = ["id_cliente", 
    						"nombre_cliente",
    						"direccion",
    						"email",
    						"telefono",
    						"moneda"
    					];
    public $rows = 10;

    public function getInfoCliente($data_json=null)
    {
    	if(is_null($data_json)){
            $data_json = new \stdClass();
        }

       if(!empty($data_json->seccion)){
            switch ($data_json->seccion) {
                case 'modal_orden':
                   $select_cliente = ["id_cliente", "nombre_cliente"];
                    
                    break;
                default:
                    $select_cliente = ["*"];
                    break;
            }
        }
        else{
           $select_cliente = ["*"];
        }

        if(!isset($data_json) && !isset($data_json->rows)){
            $data_json->rows = $this->rows;
        }

        $objCliente = new Cliente();
        $result_cliente = $objCliente
                                    ->select($select_cliente)
                                    ->where(function($query) use ($data_json){

                                        //realiza las consultas para las busquedas de cliente
                                        if(!empty($data_json) && !empty($data_json->nombre_cliente) && empty($data_json->id_cliente)){
                                            $query->where("nombre_cliente", "LIKE", "%".$data_json->nombre_cliente."%");
                                        }

                                    })
                                    ->orderBy("nombre_cliente")
                                    ->paginate($this->rows);

        return $result_cliente;
    }

    public function getClienteById($data_json)
    {
        //obtener cliente por Id
        $objCliente = new Cliente();

        if(!empty($data_json->id_cliente)){
            $result_cliente = $objCliente->where("id_cliente", $data_json->id_cliente )->first();
            /*dump($result_cliente);*/
            return $result_cliente;
        }
        else{
            return [];
        }
    }

    public function getNombreClienteById($data_json)
    {
       $objCliente = new Cliente();
       $select_cliente = ["id_cliente", "nombre_cliente", "moneda"];

        if(!empty($data_json->id_cliente)){
            $result_cliente = $objCliente->select($select_cliente)->where("id_cliente", $data_json->id_cliente )->first();
            /*dump($result_cliente);*/
            return $result_cliente;
        }
        else{
            return [];
        }
    }

    public function postCliente($data_json)
    {
        //agregar nuevo cliente
        $objCliente = new Cliente();
        $objCliente->nombre_cliente = (isset($data_json->nombre_cliente) && !empty($data_json->nombre_cliente)) ? $data_json->nombre_cliente : '';
        $objCliente->direccion = (isset($data_json->direccion) && !empty($data_json->direccion)) ? $data_json->direccion : '';
        $objCliente->email = (isset($data_json->email) && !empty($data_json->email)) ? $data_json->email : '';
        $objCliente->telefono = (isset($data_json->telefono) && !empty($data_json->telefono)) ? $data_json->telefono : '';
        $objCliente->moneda = (isset($data_json->moneda) && !empty($data_json->moneda)) ? $data_json->moneda : '';
        $objCliente->save();
        return $objCliente;

    }

    public function putCliente($data_json)
    {
        //editar cliente
       $objCliente = new Cliente();
       $array_edit_cliente = array(
            "nombre_cliente"=> (!empty($data_json->nombre_cliente)) ? $data_json->nombre_cliente : '',
            "direccion"=> (!empty($data_json->direccion)) ? $data_json->direccion : '',
            "telefono"=> (!empty($data_json->telefono)) ? $data_json->telefono : ''
       );
       if(!empty($data_json->email)){
            $array_edit_cliente["email"] = $data_json->email;
       }
       if(!empty($data_json->moneda)){
            $array_edit_cliente["moneda"] = $data_json->moneda;
       }

       $result_cliente = $objCliente
                                ->where("id_cliente", (!empty($data_json->id_cliente) ? $data_json->id_cliente : ''))
                                ->update($array_edit_cliente);

        return $result_cliente;

    }

    public function ordenes(){
        return $this->hasMany(Orden::class, 'id_cliente');
    }
}
